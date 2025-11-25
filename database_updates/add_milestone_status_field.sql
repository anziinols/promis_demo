-- ============================================================================
-- Database Update: Add 'status' field to project_milestones table
-- ============================================================================
-- Database: promis_demo_db
-- Table: project_milestones
-- Date: 2025-11-24
-- Description: Adds a new 'status' VARCHAR field to store milestone status
--              as string values (completed, pending, hold, canceled)
-- ============================================================================

-- Step 1: Add the new 'status' field after 'milestones' column
ALTER TABLE `project_milestones` 
ADD COLUMN `status` VARCHAR(50) NULL DEFAULT 'pending' 
AFTER `milestones`;

-- Step 2: Migrate existing data from 'checked' field to 'status' field
-- Convert: checked = 1 → status = 'completed'
-- Convert: checked = 0 → status = 'pending'
UPDATE `project_milestones` 
SET `status` = CASE 
    WHEN `checked` = 1 THEN 'completed'
    WHEN `checked` = 0 THEN 'pending'
    ELSE 'pending'
END;

-- Step 3: Set default value for any NULL status values
UPDATE `project_milestones` 
SET `status` = 'pending' 
WHERE `status` IS NULL OR `status` = '';

-- ============================================================================
-- VERIFICATION QUERIES (Run these to verify the update)
-- ============================================================================

-- Check the table structure
-- SHOW COLUMNS FROM `project_milestones`;

-- Check the data migration
-- SELECT id, milestones, checked, status, checked_date FROM `project_milestones` LIMIT 20;

-- Count records by status
-- SELECT status, COUNT(*) as count FROM `project_milestones` GROUP BY status;

-- ============================================================================
-- NOTES:
-- ============================================================================
-- 1. The 'checked' field is kept for backward compatibility
-- 2. The 'status' field now stores: 'completed', 'pending', 'hold', 'canceled'
-- 3. Default value is 'pending' for new records
-- 4. All existing data has been migrated from checked (0/1) to status (pending/completed)
-- ============================================================================

