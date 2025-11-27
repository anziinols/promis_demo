# Contractor Categories Seeder

## Overview
This seeder populates the `selection` table with contractor categories used in the contractor registration system.

## Categories Included (36 Total)

### Construction & Building
- Building Construction
- Road Construction
- Bridge Construction
- Civil Engineering
- Concrete Works
- Steel Fabrication
- Masonry Works
- Carpentry & Joinery
- Roofing Works
- Piling Works
- Excavation & Earthworks
- Demolition Works

### MEP (Mechanical, Electrical, Plumbing)
- Electrical Works
- Plumbing Works
- Mechanical Works
- HVAC (Heating, Ventilation & Air Conditioning)
- Fire Protection Systems

### Infrastructure & Services
- Water Supply & Drainage
- Telecommunications & IT Infrastructure
- Security Systems
- Marine & Coastal Works
- Airport Construction
- Renewable Energy Projects

### Professional Services
- Surveying Services
- Architectural Services
- Project Management
- Engineering Consultancy

### Support Services
- Landscaping & Gardening
- Painting & Decorating
- Heavy Equipment Services
- Environmental Services
- Waste Management
- Maintenance & Repair Services

### General Categories
- General Contractor (Multi-Discipline)
- Specialist Contractor
- Other Services

## How to Run the Seeder

### Option 1: Via Command Line (Recommended)

Open your terminal/command prompt and navigate to your project root, then run:

```bash
php spark db:seed ContractorCategoriesSeeder
```

### Option 2: Via XAMPP (Windows)

1. Open Command Prompt (cmd)
2. Navigate to your project directory:
   ```cmd
   cd C:\xampp\htdocs\promis_demo
   ```
3. Run the seeder:
   ```cmd
   php spark db:seed ContractorCategoriesSeeder
   ```

### Option 3: Run All Seeders

If you want to run all seeders at once, you can create a main seeder that calls all individual seeders.

## What This Seeder Does

1. **Deletes existing contractor categories**: Removes all entries in the `selection` table where `box = 'con_cat'` to avoid duplicates
2. **Inserts 36 new categories**: Adds comprehensive contractor categories to the database
3. **Provides feedback**: Shows success message with count of categories added

## Database Structure

The seeder populates the `selection` table with the following structure:

- **box**: `con_cat` (identifier for contractor categories)
- **value**: Unique slug/value for the category (e.g., `building_construction`)
- **item**: Display name for the category (e.g., `Building Construction`)

## Customization

To add or modify categories, edit the `$categories` array in the seeder file:

```php
$categories = [
    [
        'box'   => 'con_cat',
        'value' => 'your_category_slug',
        'item'  => 'Your Category Display Name'
    ],
    // ... more categories
];
```

## Testing the Seeder

After running the seeder, you can verify the categories were added by:

1. Visiting: `http://localhost/promis_demo/contractors_new`
2. Checking the "Category" dropdown - it should now show all 36 categories
3. Or checking the database directly:
   ```sql
   SELECT * FROM selection WHERE box = 'con_cat' ORDER BY item ASC;
   ```

## Notes

- The seeder uses **DELETE then INSERT** approach to ensure clean data
- All categories are sorted alphabetically in the dropdown (via `orderBy('item', 'asc')` in the controller)
- The categories can be modified at any time by editing the seeder and re-running it
- Safe to run multiple times - it cleans up old data before inserting new data

## Support

If you encounter any issues:
1. Ensure database connection is configured properly in `.env`
2. Check that the `selection` table exists in your database
3. Verify PHP CLI is accessible in your system PATH
4. Check file permissions if on Linux/Mac

## Related Files

- **Seeder**: `app/Database/Seeds/ContractorCategoriesSeeder.php`
- **Model**: `app/Models/selectionModel.php`
- **Controller**: `app/Controllers/Proleads.php` (method: `contractors_new()`)
- **View**: `app/Views/proleads/new_contractors.php`

