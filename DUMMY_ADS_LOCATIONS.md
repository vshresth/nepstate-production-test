# Dummy Ads Locations - Complete Reference

## 📋 Complete List of Dummy Ad Locations

### ✅ Working (Already Fixed):
1. **Home Page Main Ad**
   - **File:** `application/views/frontend/home.php`
   - **Line:** 122-124
   - **Status:** ✅ Working

2. **Individual Listing Detail Pages**
   - **File:** `application/views/frontend/classified-details.php`
   - **Line:** 931-937
   - **Status:** ✅ Working

### 🔧 Need to Fix (Dummy Ads):
3. **Jobs Category Page**
   - **File:** `application/views/frontend/common/listing_design.php`
   - **Line:** 55
   - **Current:** `<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad">`
   - **Replace with:** `<?php include("common/google_ads_box.php"); ?>`

4. **IT Trainings Category Page**
   - **File:** `application/views/frontend/common/listing_design.php`
   - **Line:** 61
   - **Current:** `<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad">`
   - **Replace with:** `<?php include("common/google_ads_box.php"); ?>`

5. **Forums Page - Ad 1**
   - **File:** `application/views/frontend/forums.php`
   - **Line:** 225
   - **Current:** `<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad" style="border-radius:10px">`
   - **Replace with:** `<?php include("common/google_ads_box.php"); ?>`

6. **Forums Page - Ad 2**
   - **File:** `application/views/frontend/forums.php`
   - **Line:** 230
   - **Current:** `<img src="https://via.placeholder.com/1050x190" alt="Dummy Ad" style="border-radius:10px">`
   - **Replace with:** `<?php include("common/google_ads_box.php"); ?>`

7. **Blog Sidebar**
   - **File:** `application/views/frontend/common/blog_sidebar.php`
   - **Line:** 168-174
   - **Current:** 
     ```html
     <div class="google_ad" id="dummy-ad">
        <div class="ad_inner">
           <span>Google Ad</span><br>
           <span> 350x400</span>
        </div>
     </div>
     ```
   - **Replace with:** `<?php include("google_ads_box.php"); ?>` (try different paths)

8. **Confessions Page**
   - **File:** `application/views/frontend/confessions.php`
   - **Line:** 222-224
   - **Current:** `<div class="ad-container col" id="dummy-ad">...google_ads_box.php...</div>`
   - **Status:** Already has the include, might need path fix

### 📁 File Structure:
```
application/views/frontend/
├── home.php (main home page)
├── classified-details.php (individual listings)
├── forums.php (forums page)
├── confessions.php (confessions page)
└── common/
    ├── listing_design.php (category pages)
    ├── blog_sidebar.php (blog sidebar)
    └── google_ads_box.php (the ad code file)
```

## 🔧 Troubleshooting Path Issues

If ads don't show after adding the include, try these path variations:

### From blog_sidebar.php:
- `<?php include("google_ads_box.php"); ?>`
- `<?php include("../common/google_ads_box.php"); ?>`
- `<?php include("application/views/frontend/common/google_ads_box.php"); ?>`

### From other files in common/ folder:
- `<?php include("google_ads_box.php"); ?>`

### From files in frontend/ folder:
- `<?php include("common/google_ads_box.php"); ?>`

## 🎯 Google AdSense Code Location
**File:** `application/views/frontend/common/google_ads_box.php`
**Ad Slot:** `8819937211`
**Client:** `ca-pub-4205208716712983`

## 📝 Notes
- All dummy ads should be replaced with the same Google AdSense code
- Path issues are common when files are in different directories
- Test each change individually to isolate issues
- Use browser developer tools to check for PHP errors

---
*Generated on: $(date)*
*Project: NepState - Dummy Ads Replacement Guide*
