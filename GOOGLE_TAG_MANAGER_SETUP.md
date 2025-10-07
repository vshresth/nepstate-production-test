# Google Tag Manager & Analytics Setup for NepState

## 🔍 Current Setup Analysis

### ✅ What You Have:
- Google Analytics: `G-ZBH6L00TKQ`
- Google Tag Manager: `GTM-MTNNS63M`
- Basic tracking implemented

### 🔧 Optimization Needed:
- Remove duplicate tracking (gtag + GTM)
- Add custom events for business listings
- Track user interactions
- Set up conversion goals

## 🚀 Recommended Setup

### Option 1: Use Google Tag Manager Only (Recommended)
**Remove Google Analytics direct code and use GTM to manage everything**

### Option 2: Keep Both (Current Setup)
**Optimize both codes for better tracking**

## 📝 Implementation Guide

### 1. **Optimized Header Code**

**File:** `application/views/frontend/common/header.php`

**Replace lines 20-35 with:**

```html
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id=GTM-MTNNS63M';f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MTNNS63M');</script>
<!-- End Google Tag Manager -->

<!-- Enhanced DataLayer for NepState -->
<script>
window.dataLayer = window.dataLayer || [];
dataLayer.push({
  'page_category': '<?php echo isset($page_category) ? $page_category : "general"; ?>',
  'user_type': '<?php echo isset($_SESSION["LISTYLOGIN"]) ? "logged_in" : "visitor"; ?>',
  'page_type': '<?php echo isset($page_type) ? $page_type : "listing"; ?>',
  'business_category': '<?php echo isset($business_category) ? $business_category : ""; ?>',
  'listing_id': '<?php echo isset($listing_id) ? $listing_id : ""; ?>',
  'country': '<?php echo isset($user_country) ? $user_country : ""; ?>'
});
</script>
```

### 2. **GTM Body Code**

**File:** `application/views/frontend/common/header.php` (before closing `</body>`)

**Add this before closing `</body>` tag:**
```html
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MTNNS63M"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
```

### 3. **Custom Event Tracking**

**File:** `application/views/frontend/common/footer.php`

**Add before closing `</body>`:**
```javascript
<script>
// Custom Event Tracking for NepState
function trackListingView(listingId, listingTitle, category) {
    dataLayer.push({
        'event': 'listing_view',
        'listing_id': listingId,
        'listing_title': listingTitle,
        'listing_category': category,
        'event_category': 'engagement',
        'event_label': 'listing_view'
    });
}

function trackListingClick(listingId, listingTitle, category, action) {
    dataLayer.push({
        'event': 'listing_interaction',
        'listing_id': listingId,
        'listing_title': listingTitle,
        'listing_category': category,
        'interaction_type': action, // 'phone_click', 'website_click', 'direction_click'
        'event_category': 'engagement',
        'event_label': action
    });
}

function trackSearch(searchTerm, category, location) {
    dataLayer.push({
        'event': 'search',
        'search_term': searchTerm,
        'search_category': category,
        'search_location': location,
        'event_category': 'engagement',
        'event_label': 'search'
    });
}

function trackUserAction(action, details) {
    dataLayer.push({
        'event': 'user_action',
        'action_type': action, // 'listing_create', 'login', 'signup', 'contact'
        'action_details': details,
        'event_category': 'engagement',
        'event_label': action
    });
}

// Track page views with enhanced data
$(document).ready(function() {
    // Track listing views
    if (typeof listingId !== 'undefined') {
        trackListingView(listingId, listingTitle, listingCategory);
    }
    
    // Track search form submissions
    $('form.rtcl-widget-search-form').on('submit', function() {
        var searchTerm = $(this).find('input[name="keyword"]').val();
        var category = $(this).find('select[name="countryCode"]').val();
        trackSearch(searchTerm, category, '');
    });
    
    // Track listing interactions
    $('.listing-phone, .listing-website, .listing-directions').on('click', function() {
        var action = $(this).hasClass('listing-phone') ? 'phone_click' : 
                    $(this).hasClass('listing-website') ? 'website_click' : 'direction_click';
        trackListingClick(listingId, listingTitle, listingCategory, action);
    });
});
</script>
```

### 4. **Page-Specific Tracking Variables**

**For Home Page (`application/views/frontend/home.php`):**
```php
<?php
$page_category = "home";
$page_type = "homepage";
?>
```

**For Category Pages (`application/views/frontend/common/listing_design.php`):**
```php
<?php
$page_category = "category";
$page_type = "listing_category";
$business_category = $cat_data->title;
?>
```

**For Individual Listings (`application/views/frontend/classified-details.php`):**
```php
<?php
$page_category = "listing";
$page_type = "listing_detail";
$business_category = $listing->category_name;
$listing_id = $listing->id;
?>
```

## 🎯 Google Tag Manager Configuration

### 1. **Create These Tags in GTM:**

#### **Google Analytics 4 Configuration Tag**
- **Tag Type:** Google Analytics: GA4 Configuration
- **Measurement ID:** `G-ZBH6L00TKQ`
- **Trigger:** All Pages

#### **Enhanced Ecommerce Tag**
- **Tag Type:** Google Analytics: GA4 Event
- **Event Name:** `listing_view`
- **Parameters:**
  - `listing_id`: `{{listing_id}}`
  - `listing_title`: `{{listing_title}}`
  - `listing_category`: `{{listing_category}}`

#### **Search Tracking Tag**
- **Tag Type:** Google Analytics: GA4 Event
- **Event Name:** `search`
- **Parameters:**
  - `search_term`: `{{search_term}}`
  - `search_category`: `{{search_category}}`

### 2. **Create These Variables in GTM:**

#### **Data Layer Variables**
- `listing_id`
- `listing_title`
- `listing_category`
- `page_category`
- `user_type`
- `business_category`

#### **Built-in Variables**
- Page URL
- Page Title
- Referrer
- Event

### 3. **Create These Triggers in GTM:**

#### **Custom Event Triggers**
- `listing_view`
- `listing_interaction`
- `search`
- `user_action`

#### **Page View Triggers**
- Home Page
- Category Pages
- Listing Detail Pages
- Contact Pages

## 📊 Recommended Goals/Conversions

### 1. **Primary Goals**
- **Listing Views** - Track when users view business listings
- **Contact Actions** - Phone clicks, website clicks, contact forms
- **Search Events** - Track search queries and results

### 2. **Secondary Goals**
- **User Registration** - New user signups
- **Listing Creation** - New business listings
- **Page Engagement** - Time on site, pages per session

### 3. **Ecommerce Goals** (if applicable)
- **Lead Generation** - Contact form submissions
- **Premium Listings** - Paid business listings

## 🔧 Testing & Validation

### 1. **GTM Preview Mode**
- Use GTM Preview mode to test tags
- Verify data layer pushes
- Check tag firing

### 2. **Google Analytics Real-time**
- Monitor real-time events
- Verify custom events are firing
- Check data accuracy

### 3. **Browser Developer Tools**
- Check console for errors
- Verify dataLayer pushes
- Test event tracking

## 📱 Mobile Tracking Considerations

### 1. **Mobile-Specific Events**
```javascript
// Track mobile-specific interactions
function trackMobileAction(action) {
    dataLayer.push({
        'event': 'mobile_interaction',
        'interaction_type': action,
        'device_type': 'mobile'
    });
}
```

### 2. **Touch Events**
- Track tap interactions
- Monitor mobile user behavior
- Optimize mobile conversion paths

## 🎯 NepState-Specific Tracking

### 1. **Business Listing Metrics**
- Most viewed categories
- Popular locations
- Listing interaction rates
- Search patterns

### 2. **User Behavior Analysis**
- Visitor vs logged-in user behavior
- Geographic distribution
- Device usage patterns
- Conversion funnels

### 3. **Content Performance**
- Most engaging listings
- Search query analysis
- Category popularity
- User journey mapping

---

## 🚀 Implementation Steps

1. **Week 1:** Update header code with optimized GTM
2. **Week 2:** Add custom event tracking
3. **Week 3:** Configure GTM tags and triggers
4. **Week 4:** Test and validate tracking
5. **Ongoing:** Monitor and optimize based on data

This setup will give you comprehensive tracking of user behavior on your NepState website!
