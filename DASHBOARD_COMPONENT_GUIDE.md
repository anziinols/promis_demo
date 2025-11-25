# Dashboard Component Guide

Quick reference for using and customizing the modern dashboard components.

---

## Component Library

### 1. Modern Stat Card

**Usage:**
```html
<div class="modern-stat-card">
    <div class="stat-icon icon-primary">
        <i class="fas fa-wallet"></i>
    </div>
    <div class="stat-value">K 1,250,000</div>
    <div class="stat-label">Total Budget</div>
    <div class="modern-progress">
        <div class="modern-progress-bar bg-primary" style="width: 75%"></div>
    </div>
    <div class="stat-change text-success">
        <i class="fas fa-arrow-up"></i>
        15% increase
    </div>
</div>
```

**Icon Color Variants:**
- `icon-primary` - Purple gradient
- `icon-success` - Green gradient
- `icon-warning` - Orange gradient
- `icon-danger` - Red gradient
- `icon-info` - Blue gradient
- `icon-dark` - Dark gray gradient

---

### 2. Modern Action Button

**Usage:**
```html
<a href="<?= base_url(); ?>projects" class="modern-action-btn btn-primary-border">
    <div class="btn-icon icon-primary">
        <i class="fas fa-list"></i>
    </div>
    <div class="btn-text">Projects List</div>
</a>
```

**Border Variants:**
- `btn-primary-border` - Purple border on hover
- `btn-success-border` - Green border on hover
- `btn-warning-border` - Orange border on hover
- `btn-info-border` - Blue border on hover

---

### 3. Modern Chart Card

**Usage:**
```html
<div class="modern-chart-card">
    <div class="card-header">
        <h3><i class="fas fa-chart-bar mr-2"></i>Chart Title</h3>
        <button onclick="exportPDF()" class="btn btn-sm btn-light">
            <i class="fa fa-download"></i>
        </button>
    </div>
    <div class="card-body">
        <canvas id="myChart"></canvas>
    </div>
    <div class="card-footer">
        <!-- Optional footer content -->
    </div>
</div>
```

---

### 4. Report Link Card

**Usage:**
```html
<a href="<?= base_url(); ?>reports" class="report-link-card primary">
    <div class="report-icon icon-primary">
        <i class="fas fa-list-alt"></i>
    </div>
    <h5 class="report-title">Projects Report</h5>
    <p class="text-muted mb-0 mt-2">
        <small>View all project statuses and details</small>
    </p>
</a>
```

**Card Variants:**
- `primary` - Purple hover effect
- `warning` - Orange hover effect
- `info` - Blue hover effect

---

### 5. Welcome Card

**Usage:**
```html
<div class="welcome-card">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="fas fa-chart-line mr-2"></i>Dashboard Title</h2>
            <p class="mb-0">Welcome message here</p>
        </div>
        <div class="col-md-4 text-md-right">
            <i class="fas fa-calendar-alt mr-2"></i>
            <span><?= date('l, F j, Y') ?></span>
        </div>
    </div>
</div>
```

---

### 6. Modern Milestone List

**Usage:**
```html
<ul class="modern-milestone-list">
    <li>
        <div class="milestone-label">
            <div class="milestone-icon icon-warning">
                <i class="fas fa-hourglass-half"></i>
            </div>
            <span>Pending</span>
        </div>
        <span class="milestone-badge bg-warning text-white">25</span>
    </li>
</ul>
```

---

### 7. Modern Progress Bar

**Usage:**
```html
<div class="modern-progress">
    <div class="modern-progress-bar bg-success" style="width: 65%"></div>
</div>
```

**Color Variants:**
- `bg-primary` - Purple
- `bg-success` - Green
- `bg-warning` - Orange
- `bg-danger` - Red
- `bg-info` - Blue

---

## Chart.js 3.9.1 Examples

### Doughnut Chart

```javascript
const config = {
    type: 'doughnut',
    data: {
        labels: ['Active', 'Completed', 'Hold', 'Canceled'],
        datasets: [{
            data: [10, 25, 5, 2],
            backgroundColor: [
                'rgba(102, 126, 234, 0.8)',
                'rgba(16, 185, 129, 0.8)',
                'rgba(245, 158, 11, 0.8)',
                'rgba(239, 68, 68, 0.8)',
            ],
            borderColor: [
                'rgba(102, 126, 234, 1)',
                'rgba(16, 185, 129, 1)',
                'rgba(245, 158, 11, 1)',
                'rgba(239, 68, 68, 1)',
            ],
            borderWidth: 2
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 12,
                        family: "'Inter', sans-serif"
                    }
                }
            }
        }
    }
};

const chart = new Chart(
    document.getElementById('myChart'),
    config
);
```

### Line Chart

```javascript
const config = {
    type: 'line',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        datasets: [{
            label: 'Payments',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: 'rgba(102, 126, 234, 0.1)',
            borderColor: 'rgba(102, 126, 234, 1)',
            borderWidth: 3,
            fill: true,
            tension: 0.4,
            pointBackgroundColor: 'rgba(102, 126, 234, 1)',
            pointBorderColor: '#fff',
            pointBorderWidth: 2,
            pointRadius: 5,
            pointHoverRadius: 7
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.05)'
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    }
};
```

---

## Responsive Grid Layout

### 4-Column Layout (Desktop)
```html
<div class="row">
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Card 1 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Card 2 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Card 3 -->
    </div>
    <div class="col-lg-3 col-md-6 mb-3">
        <!-- Card 4 -->
    </div>
</div>
```

### 6-Column Layout (Quick Actions)
```html
<div class="row">
    <div class="col-lg-2 col-md-4 col-sm-6 mb-3">
        <!-- Action 1 -->
    </div>
    <!-- Repeat for 6 items -->
</div>
```

---

## Color Palette

### Primary Colors
```css
--primary-color: #4f46e5;      /* Indigo */
--primary-dark: #4338ca;
--primary-light: #818cf8;
```

### Status Colors
```css
--success-color: #10b981;      /* Green */
--warning-color: #f59e0b;      /* Orange */
--danger-color: #ef4444;       /* Red */
--info-color: #3b82f6;         /* Blue */
--dark-color: #1f2937;         /* Dark Gray */
```

### Background Colors
```css
--light-bg: #f9fafb;           /* Light Gray */
```

---

## Gradient Combinations

### Primary Gradient
```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```

### Success Gradient
```css
background: linear-gradient(135deg, #10b981 0%, #059669 100%);
```

### Warning Gradient
```css
background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
```

### Danger Gradient
```css
background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
```

### Info Gradient
```css
background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
```

---

## Animation Classes

### Fade In Up
```html
<div class="animate-fade-in-up">
    <!-- Content -->
</div>
```

---

## Utility Classes

### Text Gradient
```html
<h1 class="text-gradient">Gradient Text</h1>
```

### Shadows
```css
box-shadow: var(--card-shadow);           /* Default */
box-shadow: var(--card-shadow-hover);     /* Hover */
```

---

## Customization Tips

### Change Primary Color
Update in `modern-dashboard.css`:
```css
:root {
    --primary-color: #your-color;
}
```

### Adjust Card Spacing
```css
.modern-stat-card {
    padding: 2rem;  /* Increase from 1.5rem */
}
```

### Modify Hover Effects
```css
.modern-stat-card:hover {
    transform: translateY(-4px);  /* Increase lift */
}
```

### Change Border Radius
```css
.modern-stat-card {
    border-radius: 16px;  /* Increase from 12px */
}
```

---

## Best Practices

1. **Consistency**: Use the same icon style throughout
2. **Spacing**: Maintain consistent margins and padding
3. **Colors**: Stick to the defined color palette
4. **Icons**: Use Font Awesome 6.4.0 icons
5. **Responsive**: Always test on mobile devices
6. **Accessibility**: Ensure proper color contrast
7. **Performance**: Minimize custom CSS, use classes

---

## Common Patterns

### Stat Card with Progress
```html
<div class="modern-stat-card">
    <div class="stat-icon icon-success">
        <i class="fas fa-check-circle"></i>
    </div>
    <div class="stat-value">K 850,000</div>
    <div class="stat-label">Total Paid</div>
    <div class="modern-progress">
        <div class="modern-progress-bar bg-success" style="width: 68%"></div>
    </div>
    <div class="stat-change text-success">
        <i class="fas fa-arrow-up"></i>
        68% of budget
    </div>
</div>
```

### Chart Card with Download
```html
<div class="modern-chart-card" id="myChartCard">
    <div class="card-header">
        <h3><i class="fas fa-chart-bar mr-2"></i>Statistics</h3>
        <button onclick="exportChart()" class="btn btn-sm btn-light">
            <i class="fa fa-download"></i>
        </button>
    </div>
    <div class="card-body">
        <canvas id="myChart" style="max-height: 300px;"></canvas>
    </div>
</div>
```

---

## Troubleshooting

### Cards Not Displaying Properly
- Check if `modern-dashboard.css` is loaded
- Verify Bootstrap 4.5+ is included
- Check browser console for errors

### Charts Not Rendering
- Ensure Chart.js 3.9.1 is loaded
- Check canvas element has an ID
- Verify data is properly formatted

### Hover Effects Not Working
- Check CSS transitions are enabled
- Verify no conflicting styles
- Test in different browsers

### Responsive Issues
- Use proper Bootstrap grid classes
- Test at different breakpoints
- Check viewport meta tag

---

## Support

For issues or questions:
1. Check browser console for errors
2. Verify all CSS/JS files are loaded
3. Test in different browsers
4. Review this guide for proper usage

