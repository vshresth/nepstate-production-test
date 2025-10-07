# Google Analytics Goals & Events Setup for NepState

## 🎯 Essential Goals to Track

### 1. **Primary Business Goals**

#### **Listing Views (Most Important)**
- **Goal Type:** Event
- **Event Name:** `listing_view`
- **Description:** Track when users view business listings
- **Value:** High priority - shows user engagement

#### **Contact Actions**
- **Goal Type:** Event
- **Event Name:** `contact_action`
- **Description:** Track phone clicks, website visits, contact forms
- **Value:** Conversion goal - shows business value

#### **User Registration**
- **Goal Type:** Event
- **Event Name:** `user_signup`
- **Description:** Track new user registrations
- **Value:** Growth metric - shows community expansion

### 2. **Secondary Goals**

#### **Search Activity**
- **Goal Type:** Event
- **Event Name:** `search_performed`
- **Description:** Track search queries and results
- **Value:** User intent - shows what people want

#### **Category Engagement**
- **Goal Type:** Event
- **Event Name:** `category_view`
- **Description:** Track category page visits
- **Value:** Content performance - shows popular categories

## 🔧 How to Set Up Goals in GA4

### **Step 1: Access GA4 Goals**
1. Go to your Google Analytics dashboard
2. Click **Configure** → **Events**
3. Click **Create Event**

### **Step 2: Create Custom Events**

#### **Listing View Event:**
```
Event Name: listing_view
Conditions:
- page_location contains "classified/detail"
- OR page_title contains business listing
```

#### **Contact Action Event:**
```
Event Name: contact_action
Conditions:
- event_name equals "click"
- AND click_element contains "phone"
- OR click_element contains "website"
- OR click_element contains "contact"
```

#### **Search Event:**
```
Event Name: search_performed
Conditions:
- page_location contains "search"
- OR event_name equals "search"
```

### **Step 3: Mark as Conversions**
1. Go to **Configure** → **Conversions**
2. Click **New Conversion Event**
3. Add your custom events:
   - `listing_view`
   - `contact_action`
   - `user_signup`

## 📊 Key Reports to Monitor

### **1. Real-Time Reports**
- **Current visitors** - Live activity
- **Traffic sources** - Where people come from
- **Popular pages** - What's trending now

### **2. Acquisition Reports**
- **Traffic sources** - Google, Facebook, direct visits
- **Search queries** - What people search for
- **Referral traffic** - Other websites linking to you

### **3. Engagement Reports**
- **Page views** - Most popular content
- **Session duration** - How long people stay
- **Bounce rate** - Pages people leave quickly

### **4. Demographics & Interests**
- **Age groups** - Who uses your site
- **Geographic data** - Where your users are located
- **Device usage** - Mobile vs desktop

### **5. Conversions**
- **Goal completions** - How many achieve your goals
- **Conversion paths** - User journey to goals
- **Revenue tracking** - If you have paid features

## 🎯 NepState-Specific Insights

### **Business Listing Performance**
- **Most viewed categories** - Restaurants, Jobs, Events
- **Popular locations** - Which cities/countries use your site
- **Listing interaction rates** - Which businesses get most contact

### **User Behavior Patterns**
- **Peak usage times** - When people are most active
- **Session duration** - How engaged users are
- **Return visitor rate** - How often people come back

### **Geographic Insights**
- **Top countries** - Where your Nepalese community is
- **City-level data** - Specific locations with high usage
- **Language preferences** - English vs Nepali usage

### **Content Performance**
- **Most popular listings** - Which businesses are trending
- **Category popularity** - Jobs vs Restaurants vs Events
- **Search trends** - What people are looking for

## 📱 Mobile vs Desktop Analysis

### **Device Usage**
- **Mobile percentage** - How many use phones
- **Desktop behavior** - Different usage patterns
- **Tablet usage** - Alternative device insights

### **Mobile-Specific Metrics**
- **Touch interactions** - Mobile user behavior
- **App-like usage** - Mobile engagement patterns
- **Location-based searches** - Mobile local searches

## 🔍 Advanced Analytics Features

### **1. Custom Dimensions**
Set up custom tracking for:
- **Business categories** - Restaurant, Job, Event, etc.
- **User types** - Logged in vs visitor
- **Geographic regions** - Country, state, city
- **Listing types** - Free vs premium listings

### **2. Audience Segments**
Create specific audiences:
- **Frequent visitors** - People who visit often
- **Mobile users** - Mobile-only segment
- **Geographic segments** - Users by location
- **Category interests** - Users by business type

### **3. Custom Reports**
Build reports for:
- **Business performance** - Which listings perform best
- **Geographic analysis** - Location-based insights
- **Time-based trends** - Usage patterns over time
- **Conversion funnels** - User journey analysis

## 📈 Actionable Insights You'll Get

### **Business Optimization**
- **Focus on popular categories** - Invest more in what works
- **Improve underperforming areas** - Fix what's not working
- **Geographic expansion** - Target new locations
- **Content strategy** - Create more of what's popular

### **User Experience Improvements**
- **Fix high bounce rate pages** - Improve user engagement
- **Optimize mobile experience** - Since most users are mobile
- **Improve site speed** - Technical performance
- **Better navigation** - Based on user behavior

### **Marketing Strategy**
- **Target popular traffic sources** - Focus marketing efforts
- **Geographic targeting** - Where to advertise
- **Content marketing** - What content to create
- **SEO optimization** - Improve search rankings

## 🎯 Monthly Analytics Review

### **Key Metrics to Track Monthly:**
1. **Total users** - Growth over time
2. **Page views** - Content performance
3. **Session duration** - User engagement
4. **Bounce rate** - Site quality indicator
5. **Conversion rate** - Goal achievement
6. **Top traffic sources** - Marketing effectiveness
7. **Geographic growth** - Market expansion
8. **Popular categories** - Business focus areas

### **Action Items Based on Data:**
- **High bounce rate pages** → Improve content/design
- **Low engagement** → Add more interactive features
- **Mobile issues** → Optimize mobile experience
- **Popular content** → Create more similar content
- **Geographic gaps** → Target new markets

---

## 🚀 Next Steps

1. **Week 1:** Set up basic goals and events
2. **Week 2:** Create custom dimensions for business data
3. **Week 3:** Build custom reports for NepState insights
4. **Week 4:** Analyze data and create action plan
5. **Monthly:** Review and optimize based on insights

Google Analytics will become your most valuable tool for understanding and growing your NepState community!
