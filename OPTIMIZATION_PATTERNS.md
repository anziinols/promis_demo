# Database Retrieval Optimization Patterns

Quick reference guide for optimized database query patterns used in this project.

---

## Pattern 1: Cache Session Values

### ❌ Before (Inefficient)
```php
public function index()
{
    $data['org'] = $this->orgModel->where('orgcode', session('orgcode'))->first();
    $data['projects'] = $this->projectsModel->where('orgcode', session('orgcode'))->find();
    $data['payments'] = $this->profundModel->where('orgcode', session('orgcode'))->find();
    // session('orgcode') called 3 times
}
```

### ✅ After (Optimized)
```php
public function index()
{
    // Cache session value once
    $orgcode = session('orgcode');
    
    $data['org'] = $this->orgModel->where('orgcode', $orgcode)->first();
    $data['projects'] = $this->projectsModel->where('orgcode', $orgcode)->find();
    $data['payments'] = $this->profundModel->where('orgcode', $orgcode)->find();
}
```

**Benefits**: Reduces function call overhead, improves readability

---

## Pattern 2: Use SELECT for Specific Columns

### ❌ Before (Inefficient)
```php
// Fetches ALL columns (SELECT *)
$data['projects'] = $this->projectsModel
    ->where('orgcode', $orgcode)
    ->find();
```

### ✅ After (Optimized)
```php
// Fetches only needed columns
$data['projects'] = $this->projectsModel
    ->select('procode, name, status, budget, payment_total')
    ->where('orgcode', $orgcode)
    ->find();
```

**Benefits**: Reduces data transfer by 40-60%, faster query execution

---

## Pattern 3: Filter in PHP Instead of Multiple Queries

### ❌ Before (Inefficient - 4 queries)
```php
$data['projects'] = $this->projectsModel->where('orgcode', $orgcode)->find();
$data['pro_active'] = $this->projectsModel->where('orgcode', $orgcode)->where('status', 'active')->find();
$data['pro_completed'] = $this->projectsModel->where('orgcode', $orgcode)->where('status', 'completed')->find();
$data['pro_hold'] = $this->projectsModel->where('orgcode', $orgcode)->where('status', 'hold')->find();
$data['pro_canceled'] = $this->projectsModel->where('orgcode', $orgcode)->where('status', 'canceled')->find();
```

### ✅ After (Optimized - 1 query)
```php
// Fetch once
$data['projects'] = $this->projectsModel
    ->select('procode, name, status, budget, payment_total')
    ->where('orgcode', $orgcode)
    ->find();

// Filter in PHP
$data['pro_active'] = [];
$data['pro_completed'] = [];
$data['pro_hold'] = [];
$data['pro_canceled'] = [];

foreach ($data['projects'] as $pro) {
    switch ($pro['status']) {
        case 'active':
            $data['pro_active'][] = $pro;
            break;
        case 'completed':
            $data['pro_completed'][] = $pro;
            break;
        case 'hold':
            $data['pro_hold'][] = $pro;
            break;
        case 'canceled':
            $data['pro_canceled'][] = $pro;
            break;
    }
}
```

**Benefits**: Reduces queries from 5 to 1, faster overall execution

---

## Pattern 4: Combine Calculations with Iteration

### ❌ Before (Inefficient - Multiple loops)
```php
$data['projects'] = $this->projectsModel->where('orgcode', $orgcode)->find();

// First loop - extract IDs
$projectsID = [];
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
}

// Second loop - calculate totals
$data['pro_total_budget'] = 0;
foreach ($data['projects'] as $pay) {
    $data['pro_total_budget'] += checkZero($pay['budget']);
    $data['pro_total_paid'] += checkZero($pay['payment_total']);
}
```

### ✅ After (Optimized - Single loop)
```php
$data['projects'] = $this->projectsModel
    ->select('procode, name, status, budget, payment_total')
    ->where('orgcode', $orgcode)
    ->find();

// Initialize
$data['pro_total_budget'] = $data['pro_total_paid'] = 0;
$projectsID = [];

// Single loop - do everything
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
    
    // Calculate totals
    $data['pro_total_budget'] += checkZero($pro['budget']);
    $data['pro_total_paid'] += checkZero($pro['payment_total']);
    
    // Filter by status
    if ($pro['status'] == 'active') {
        $data['pro_active'][] = $pro;
    }
}
```

**Benefits**: Reduces loop iterations, better CPU cache utilization

---

## Pattern 5: Remove Duplicate Queries

### ❌ Before (Inefficient - Overwrites data)
```php
// First query - fetched but overwritten
$data['payments'] = $this->profundModel->where('orgcode', $orgcode)->find();

// Build project IDs
$projectsID = [];
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
}

// Second query - overwrites first query
$data['payments'] = $this->profundModel
    ->whereIn('procode', $projectsID)
    ->where('orgcode', $orgcode)
    ->find();
```

### ✅ After (Optimized - Single query)
```php
// Build project IDs first
$projectsID = [];
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
}

// Single query with proper filtering
if (!empty($projectsID)) {
    $data['payments'] = $this->profundModel
        ->select('procode, amount, paymentdate')
        ->whereIn('procode', $projectsID)
        ->where('orgcode', $orgcode)
        ->find();
} else {
    $data['payments'] = [];
}
```

**Benefits**: Eliminates wasted query, clearer intent

---

## Pattern 6: Use array_unique() Before whereIn()

### ❌ Before (Inefficient - Duplicate values)
```php
$country = $province = [];
foreach ($data['projects'] as $pro) {
    $country[] = $pro['country'];      // May have duplicates
    $province[] = $pro['province'];    // May have duplicates
}

// Query with duplicates
$data['country'] = $this->countryModel
    ->whereIn('code', $country)  // e.g., ['PNG', 'PNG', 'PNG']
    ->find();
```

### ✅ After (Optimized - Unique values)
```php
$country = $province = [];
foreach ($data['projects'] as $pro) {
    if (!empty($pro['country'])) $country[] = $pro['country'];
    if (!empty($pro['province'])) $province[] = $pro['province'];
}

// Remove duplicates
$country = array_unique($country);
$province = array_unique($province);

// Query with unique values only
if (!empty($country)) {
    $data['country'] = $this->countryModel
        ->select('code, name')
        ->whereIn('code', $country)  // e.g., ['PNG']
        ->find();
} else {
    $data['country'] = [];
}
```

**Benefits**: Prevents duplicate lookups, cleaner SQL

---

## Pattern 7: Use Switch Instead of Multiple Ifs

### ❌ Before (Less efficient)
```php
foreach ($data['milestones'] as $ms) {
    if ($ms['checked'] == 'pending') {
        $data['pro_ms_pending'] += 1;
    }
    if ($ms['checked'] == 'completed') {
        $data['pro_ms_completed'] += 1;
    }
    if ($ms['checked'] == 'hold') {
        $data['pro_ms_hold'] += 1;
    }
    if ($ms['checked'] == 'canceled') {
        $data['pro_ms_canceled'] += 1;
    }
}
```

### ✅ After (More efficient)
```php
foreach ($data['milestones'] as $ms) {
    switch ($ms['checked']) {
        case 'pending':
            $data['pro_ms_pending'] += 1;
            break;
        case 'completed':
            $data['pro_ms_completed'] += 1;
            break;
        case 'hold':
            $data['pro_ms_hold'] += 1;
            break;
        case 'canceled':
            $data['pro_ms_canceled'] += 1;
            break;
    }
}
```

**Benefits**: Stops checking after first match, clearer logic

---

## Pattern 8: Check Empty Arrays Before whereIn()

### ❌ Before (Causes SQL error)
```php
$projectsID = [];
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
}

// If $projectsID is empty, generates: WHERE procode IN ()
// This causes SQL syntax error!
$data['payments'] = $this->profundModel
    ->whereIn('procode', $projectsID)
    ->where('orgcode', $orgcode)
    ->find();
```

### ✅ After (Safe)
```php
$projectsID = [];
foreach ($data['projects'] as $pro) {
    $projectsID[] = $pro['procode'];
}

// Check before querying
if (!empty($projectsID)) {
    $data['payments'] = $this->profundModel
        ->select('procode, amount, paymentdate')
        ->whereIn('procode', $projectsID)
        ->where('orgcode', $orgcode)
        ->find();
} else {
    $data['payments'] = [];
}
```

**Benefits**: Prevents SQL errors, handles edge cases

---

## Pattern 9: Fetch Only Related Location Data

### ❌ Before (Inefficient - Fetches ALL)
```php
// Fetches ALL countries from database (could be 200+ countries)
$data['country'] = $this->countryModel->orderBy('name', 'asc')->find();
$data['province'] = $this->provinceModel->orderBy('name', 'asc')->find();
$data['district'] = $this->districtModel->orderBy('name', 'asc')->find();

// Later, filters to only used ones (wasteful)
$country = [];
foreach ($data['projects'] as $pro) {
    $country[] = $pro['country'];
}
$data['country'] = $this->countryModel->whereIn('code', $country)->find();
```

### ✅ After (Optimized - Fetches only used)
```php
// Extract used location codes
$country = [];
foreach ($data['projects'] as $pro) {
    if (!empty($pro['country'])) $country[] = $pro['country'];
}
$country = array_unique($country);

// Fetch only used locations
$data['country'] = !empty($country)
    ? $this->countryModel
        ->select('code, name')
        ->whereIn('code', $country)
        ->orderBy('name', 'asc')
        ->find()
    : [];
```

**Benefits**: Reduces data transfer dramatically, faster queries

---

## Pattern 10: Ternary for Conditional Queries

### ❌ Before (More verbose)
```php
if (!empty($country)) {
    $data['country'] = $this->countryModel
        ->select('code, name')
        ->whereIn('code', $country)
        ->find();
} else {
    $data['country'] = [];
}
```

### ✅ After (More concise)
```php
$data['country'] = !empty($country)
    ? $this->countryModel
        ->select('code, name')
        ->whereIn('code', $country)
        ->find()
    : [];
```

**Benefits**: More concise, easier to read

---

## Complete Example: Optimized Dashboard Method

```php
public function index()
{
    $data['title'] = "Dashboard";
    $data['menu'] = "dashboard";

    // 1. Cache session values
    $orgcode = session('orgcode');

    // 2. Fetch with SELECT optimization
    $data['org'] = $this->orgModel
        ->select('name, orgcode, orglogo')
        ->where('orgcode', $orgcode)
        ->first();

    $data['projects'] = $this->projectsModel
        ->select('procode, name, status, budget, payment_total')
        ->where('orgcode', $orgcode)
        ->find();

    // 3. Initialize
    $data['pro_total_budget'] = $data['pro_total_paid'] = 0;
    $data['pro_active'] = [];
    $data['pro_completed'] = [];
    $projectsID = [];

    // 4. Single loop for multiple operations
    foreach ($data['projects'] as $pro) {
        $projectsID[] = $pro['procode'];
        
        // Calculate totals
        $data['pro_total_budget'] += checkZero($pro['budget']);
        $data['pro_total_paid'] += checkZero($pro['payment_total']);
        
        // Filter by status
        switch ($pro['status']) {
            case 'active':
                $data['pro_active'][] = $pro;
                break;
            case 'completed':
                $data['pro_completed'][] = $pro;
                break;
        }
    }

    // 5. Check before whereIn
    if (!empty($projectsID)) {
        $data['payments'] = $this->profundModel
            ->select('procode, amount, paymentdate')
            ->whereIn('procode', $projectsID)
            ->where('orgcode', $orgcode)
            ->find();
    } else {
        $data['payments'] = [];
    }

    echo view('dashboard', $data);
}
```

---

## Summary Checklist

When writing database queries, always:

- [ ] Cache session values at the start
- [ ] Use `select()` to specify only needed columns
- [ ] Check if data is already loaded before querying again
- [ ] Combine multiple loops into one when possible
- [ ] Use `switch` instead of multiple `if` statements
- [ ] Use `array_unique()` before `whereIn()` queries
- [ ] Check for empty arrays before `whereIn()` queries
- [ ] Fetch only related data, not all data
- [ ] Use ternary operators for simple conditionals
- [ ] Add comments explaining optimization choices

