# Modern Dashboard - Quick Reference Card

## 🎨 CSS Classes Reference

### Stat Cards
```html
<div class="modern-stat-card">
    <div class="stat-icon icon-primary">
        <i class="fas fa-icon"></i>
    </div>
    <div class="stat-value">1,234</div>
    <div class="stat-label">Label Text</div>
    <div class="modern-progress">
        <div class="modern-progress-bar bg-success" style="width: 75%"></div>
    </div>
    <div class="stat-change text-success">
        <i class="fas fa-arrow-up"></i> 15% increase
    </div>
</div>
```

### Action Buttons
```html
<a href="#" class="modern-action-btn btn-primary-border">
    <div class="btn-icon icon-primary">
        <i class="fas fa-icon"></i>
    </div>
    <div class="btn-text">Button Text</div>
</a>
```

### Chart Cards
```html
<div class="modern-chart-card">
    <div class="card-header">
        <h3><i class="fas fa-chart-bar mr-2"></i>Title</h3>
        <button class="btn btn-sm btn-light">
            <i class="fa fa-download"></i>
        </button>
    </div>
    <div class="card-body">
        <canvas id="myChart"></canvas>
    </div>
</div>
```

### Report Links
```html
<a href="#" class="report-link-card primary">
    <div class="report-icon icon-primary">
        <i class="fas fa-icon"></i>
    </div>
    <h5 class="report-title">Title</h5>
    <p class="text-muted mb-0 mt-2">
        <small>Description</small>
    </p>
</a>
```

### Welcome Card
```html
<div class="welcome-card">
    <h2><i class="fas fa-icon mr-2"></i>Title</h2>
    <p class="mb-0">Welcome message</p>
</div>
```

---

## 🎨 Icon Color Variants

| Class | Color | Use For |
|-------|-------|---------|
| `icon-primary` | Purple | Main actions, primary stats |
| `icon-success` | Green | Completed, paid, success |
| `icon-warning` | Orange | Pending, outstanding, warnings |
| `icon-danger` | Red | Errors, overpaid, critical |
| `icon-info` | Blue | Information, general stats |
| `icon-dark` | Dark Gray | Settings, account |

---

## 📊 Chart.js 3.9.1 Quick Setup

### Doughnut Chart
```javascript
const config = {
    type: 'doughnut',
    data: {
        labels: ['Label 1', 'Label 2'],
        datasets: [{
            data: [10, 20],
            backgroundColor: [
                'rgba(102, 126, 234, 0.8)',
                'rgba(16, 185, 129, 0.8)'
            ]
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { position: 'bottom' }
        }
    }
};
new Chart(document.getElementById('myChart'), config);
```

### Line Chart
```javascript
const config = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar'],
        datasets: [{
            label: 'Data',
            data: [10, 20, 15],
            borderColor: 'rgba(102, 126, 234, 1)',
            tension: 0.4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: { beginAtZero: true }
        }
    }
};
new Chart(document.getElementById('myChart'), config);
```

---

## 📐 Responsive Grid

### 4-Column Layout
```html
<div class="row">
    <div class="col-lg-3 col-md-6 mb-3"><!-- Card 1 --></div>
    <div class="col-lg-3 col-md-6 mb-3"><!-- Card 2 --></div>
    <div class="col-lg-3 col-md-6 mb-3"><!-- Card 3 --></div>
    <div class="col-lg-3 col-md-6 mb-3"><!-- Card 4 --></div>
</div>
```

### 6-Column Layout
```html
<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-3"><!-- Item 1 --></div>
    <!-- Repeat 6 times -->
</div>
```

---

## 🎨 Color Palette

### CSS Variables
```css
--primary-color: #4f46e5
--success-color: #10b981
--warning-color: #f59e0b
--danger-color: #ef4444
--info-color: #3b82f6
--dark-color: #1f2937
```

### Gradients
```css
Primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%)
Success: linear-gradient(135deg, #10b981 0%, #059669 100%)
Warning: linear-gradient(135deg, #f59e0b 0%, #d97706 100%)
Danger: linear-gradient(135deg, #ef4444 0%, #dc2626 100%)
```

---

## 📱 Breakpoints

| Device | Width | Grid Columns |
|--------|-------|--------------|
| Mobile | < 768px | 1 column |
| Tablet | 768px - 1024px | 2 columns |
| Desktop | > 1024px | 4 columns |

---

## 🔧 Common Patterns

### Page Header
```html
<div class="welcome-card animate-fade-in-up">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-icon mr-2"></i>Page Title</h2>
            <p class="mb-0">Description</p>
        </div>
        <div class="col-md-4 text-md-right">
            <i class="fas fa-calendar-alt mr-2"></i>
            <span><?= date('l, F j, Y') ?></span>
        </div>
    </div>
</div>
```

### Section Header
```html
<div class="row mb-4">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="fas fa-icon mr-2 text-gradient"></i>
            Section Title
        </h5>
    </div>
</div>
```

### Stats Row
```html
<div class="row mb-4">
    <div class="col-12">
        <h5 class="mb-3">
            <i class="fas fa-chart-line mr-2 text-gradient"></i>
            Statistics
        </h5>
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Stat Card 1 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Stat Card 2 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Stat Card 3 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Stat Card 4 -->
    </div>
</div>
```

---

## 📋 Template Usage

### Extend Template
```php
<?= $this->extend('templates/adminlte/dboard') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-3">
    <!-- Your content here -->
</div>

<?= $this->endSection(); ?>
```

### Set Menu Active
In your controller:
```php
$data['menu'] = 'projects'; // Matches menu item
```

---

## 🎯 Font Awesome Icons

### Common Icons
```html
<i class="fas fa-tachometer-alt"></i>  <!-- Dashboard -->
<i class="fas fa-list-alt"></i>        <!-- List -->
<i class="fas fa-plus-circle"></i>     <!-- Add -->
<i class="fas fa-edit"></i>            <!-- Edit -->
<i class="fas fa-trash"></i>           <!-- Delete -->
<i class="fas fa-chart-bar"></i>       <!-- Chart -->
<i class="fas fa-users"></i>           <!-- Users -->
<i class="fas fa-cog"></i>             <!-- Settings -->
<i class="fas fa-download"></i>        <!-- Download -->
<i class="fas fa-upload"></i>          <!-- Upload -->
```

---

## ⚡ Performance Tips

1. **Load CSS in template** (already done)
2. **Use CSS classes** instead of inline styles
3. **Minimize custom CSS**
4. **Optimize images**
5. **Use CDN for libraries**

---

## 🐛 Debugging

### CSS Not Loading
```bash
# Check file exists
ls public/assets/css/modern-dashboard.css

# Check browser console
F12 > Console > Look for 404 errors
```

### Styles Not Applying
1. Clear browser cache (Ctrl+Shift+R)
2. Check CSS class spelling
3. Verify template is extended correctly
4. Check for CSS conflicts

---

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| `DASHBOARD_MODERNIZATION_SUMMARY.md` | Complete overview |
| `DASHBOARD_COMPONENT_GUIDE.md` | Component examples |
| `TEMPLATE_UPDATE_SUMMARY.md` | Template integration |
| `QUICK_REFERENCE.md` | This file |

---

## 🚀 Quick Start

### Create a New Page with Modern Design

1. **Create Controller Method**
```php
public function myPage()
{
    $data['title'] = "My Page";
    $data['menu'] = "mypage";
    echo view('mypage/index', $data);
}
```

2. **Create View File** (`app/Views/mypage/index.php`)
```php
<?= $this->extend('templates/adminlte/dboard') ?>
<?= $this->section('content') ?>

<div class="container-fluid px-4 py-3">
    
    <!-- Welcome Header -->
    <div class="welcome-card animate-fade-in-up">
        <h2><i class="fas fa-icon mr-2"></i>My Page</h2>
        <p class="mb-0">Page description</p>
    </div>

    <!-- Stats -->
    <div class="row mb-4">
        <div class="col-lg-3 col-md-6 mb-3">
            <div class="modern-stat-card">
                <div class="stat-icon icon-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-value">150</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
    </div>

</div>

<?= $this->endSection(); ?>
```

3. **Add Route** (`app/Config/Routes.php`)
```php
$routes->get('mypage', 'MyController::myPage');
```

4. **Done!** Modern design automatically applied.

---

## 💡 Pro Tips

1. **Use consistent spacing**: Always use `mb-3` or `mb-4` for margins
2. **Group related items**: Use section headers to organize content
3. **Keep it simple**: Don't overuse gradients and effects
4. **Test responsive**: Always check mobile view
5. **Use icons**: They improve visual communication
6. **Follow patterns**: Use existing components as templates
7. **Maintain consistency**: Stick to the color palette

---

## 🎨 Customization Quick Guide

### Change Primary Color
Edit `public/assets/css/modern-dashboard.css`:
```css
:root {
    --primary-color: #your-color;
}
```

### Change Sidebar Background
Edit template file:
```html
<aside style="background: linear-gradient(180deg, #color1 0%, #color2 100%);">
```

### Add Custom Component
Add to `modern-dashboard.css`:
```css
.my-custom-component {
    /* Your styles */
}
```

---

## ✅ Checklist for New Pages

- [ ] Extend correct template
- [ ] Set page title in `$data['title']`
- [ ] Set menu active in `$data['menu']`
- [ ] Use container-fluid with px-4 py-3
- [ ] Add welcome card for page header
- [ ] Use modern components
- [ ] Test responsive layout
- [ ] Check all links work
- [ ] Verify icons display
- [ ] Test in different browsers

---

**Need Help?** Check the full documentation files or review existing pages for examples!

