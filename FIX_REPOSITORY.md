# Repository Corruption Fix

## Problem
The sparse checkout combined with invalid file paths has corrupted the working tree. Files like `bootstrap/app.php` are missing even though they exist in Git.

## Solution: Fresh Clone

The repository needs to be re-cloned. Follow these steps:

### Step 1: Backup Your Work
```bash
# Save your current .env file
copy .env .env.backup

# Note your current branch
git branch
```

### Step 2: Move to Parent Directory and Re-clone
```bash
# Go to parent directory
cd ..

# Rename current directory
move e-learning e-learning-old

# Fresh clone with protectNTFS disabled
git clone https://github.com/CodeJocker/e-learning-dynasoft e-learning
cd e-learning

# Configure Git
git config core.protectNTFS false

# Checkout your branch
git checkout kevin
```

### Step 3: Restore Your Environment
```bash
# Copy back your .env file
copy ..\e-learning-old\.env .env

# Install dependencies
composer install
npm install

# Create storage directories
mkdir storage\framework\views
mkdir storage\framework\cache
mkdir storage\framework\sessions
mkdir storage\logs

# Set permissions (if needed)
# On Windows, usually not required

# Generate app key if needed
php artisan key:generate
```

### Step 4: Start Development Servers
```bash
# Terminal 1: Start Vite
npm run dev

# Terminal 2: Start Laravel (in a new terminal)
php artisan serve
```

### Step 5: Clean Up Old Directory
Once everything works:
```bash
# Go to parent directory
cd ..

# Remove old directory
rmdir /s e-learning-old
```

## Alternative: Quick Fix (May Not Work)

If you want to try fixing without re-cloning:

```bash
# Remove sparse checkout config
rd /s /q .git\info\sparse-checkout 2>nul

# Reset Git config
git config --unset core.sparseCheckout

# Force checkout all files
git checkout -f HEAD

# If that doesn't work, try:
git rm -r --cached .
git reset --hard HEAD
```

## Prevention

The `.gitignore` has been updated to prevent this in the future. The invalid files in the repository should be removed by the repository owner.

## Current Status

✅ Tailwind CSS configuration is correct
✅ Git configuration is set (`core.protectNTFS false`)
✅ `.gitignore` updated
❌ Working tree corrupted by sparse checkout
❌ Need fresh clone to restore all files

## Why This Happened

1. Someone committed files with invalid absolute paths to `main`
2. Git enabled sparse checkout to handle the invalid paths
3. This caused only partial files to be checked out
4. Laravel can't find required files like `bootstrap/app.php`

## After Fresh Clone

Everything should work normally:
- Tailwind CSS will compile correctly
- Laravel commands will work
- All files will be present
- Future pulls will work with `core.protectNTFS false`
