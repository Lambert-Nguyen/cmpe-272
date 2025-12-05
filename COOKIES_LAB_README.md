# 🍪 Web Cookies Tracking Lab - Implementation Guide

## Overview
This document describes the web cookies tracking implementation for the Lambert Engineering & Business Solutions website products section (CMPE 272 Lab - Tracking with Web Cookies).

---

## 📋 Requirements Met

### ✅ Core Requirements
1. ✅ **Modified Products/Services section** - Added 10 detailed products
2. ✅ **Individual product pages** - Each product has its own page with descriptions and images
3. ✅ **Cookie tracking** - Tracks last 5 previously visited products using PHP cookies
4. ✅ **Recently visited link** - Added link to show last 5 previously visited products

### ✅ Extra Credit
5. ✅ **Visit count tracking** - Uses cookies to track how many times each product is visited
6. ✅ **Most visited link** - Added link to show 5 most visited products

---

## 🎯 Implementation Summary

### 10 Products Created

All products include:
- Unique ID
- Name and category
- High-quality images (Unsplash)
- Short and detailed descriptions
- Key features list
- Technologies used
- Price range
- Related products

**Product Catalog:**
1. **Custom Web Application Development** - Software Development
2. **Cloud Migration & Deployment** - Cloud Services
3. **Mobile App Development (iOS & Android)** - Mobile Solutions
4. **AI & Machine Learning Solutions** - Artificial Intelligence
5. **Enterprise Resource Planning (ERP)** - Enterprise Software
6. **E-Commerce Platform Development** - E-Commerce
7. **Cybersecurity & Penetration Testing** - Security Services
8. **DevOps & CI/CD Implementation** - DevOps
9. **Data Analytics & Business Intelligence** - Data Solutions
10. **API Development & Integration** - Integration Services

---

## 🔧 Technical Implementation

### File Structure

```
src/
├── Controllers/
│   ├── ProductController.php         # Product logic & cookie tracking
│   └── CompanyController.php         # Updated to use ProductController
└── Views/
    ├── company/
    │   └── products.php              # Updated product listing
    └── products/
        ├── show.php                  # Individual product page
        ├── recently-visited.php      # Last 5 visited products
        └── most-visited.php          # Top 5 most visited (Extra)
```

### Routes Added

```php
// Product routes (cookie tracking)
GET  /products/show?id={id}           # Individual product page
GET  /products/recently-visited       # Last 5 visited products
GET  /products/most-visited           # Top 5 most visited products
```

---

## 🍪 Cookie Tracking Mechanism

### 1. Recently Visited Tracking

**Cookie Name:** `recently_visited`

**How it works:**
1. When user visits a product page (`/products/show?id=X`)
2. Product ID is added to the beginning of the array
3. If product was already in the list, it's moved to the front
4. Array is limited to 5 most recent IDs
5. Stored as JSON in cookie for 30 days

**Code Implementation:**
```php
private function trackProductVisit($productId) {
    $recentIds = $this->getRecentlyVisitedIds();
    
    // Remove if already exists (to move to front)
    $recentIds = array_filter($recentIds, function($id) use ($productId) {
        return $id != $productId;
    });
    
    // Add to front
    array_unshift($recentIds, $productId);
    
    // Keep only last 5
    $recentIds = array_slice($recentIds, 0, 5);
    
    // Store in cookie (30 days)
    setcookie('recently_visited', json_encode($recentIds), 
              time() + (30 * 24 * 60 * 60), '/');
}
```

**Cookie Format:**
```json
[3, 1, 7, 10, 2]  // Array of product IDs, most recent first
```

### 2. Visit Count Tracking (Extra Credit)

**Cookie Name:** `visit_counts`

**How it works:**
1. Maintains a counter for each product ID
2. Increments counter every time product is viewed
3. Stored as JSON object mapping product ID to count
4. Used to determine most visited products
5. Stored in cookie for 30 days

**Code Implementation:**
```php
// Track visit count (for most visited feature - Extra Credit)
$visitCounts = isset($_COOKIE['visit_counts']) 
    ? json_decode($_COOKIE['visit_counts'], true) 
    : [];

if (!isset($visitCounts[$productId])) {
    $visitCounts[$productId] = 0;
}
$visitCounts[$productId]++;

// Store in cookie (30 days)
setcookie('visit_counts', json_encode($visitCounts), 
          time() + (30 * 24 * 60 * 60), '/');
```

**Cookie Format:**
```json
{
  "1": 5,   // Product 1 visited 5 times
  "3": 8,   // Product 3 visited 8 times
  "7": 3,   // Product 7 visited 3 times
  "10": 2   // Product 10 visited 2 times
}
```

### 3. Most Visited Algorithm

```php
private function getMostVisitedProducts() {
    $visitCounts = isset($_COOKIE['visit_counts']) 
        ? json_decode($_COOKIE['visit_counts'], true) 
        : [];
    
    if (empty($visitCounts)) {
        return [];
    }
    
    // Sort by visit count descending
    arsort($visitCounts);
    
    // Get top 5
    $top5 = array_slice($visitCounts, 0, 5, true);
    
    $result = [];
    foreach ($top5 as $id => $count) {
        $result[] = ['id' => $id, 'count' => $count];
    }
    
    return $result;
}
```

---

## 🎨 User Interface Features

### Products Listing Page (`/company/products`)

**Features:**
- Grid layout with 10 products (5 rows × 2 columns)
- High-quality product images
- Hover effects with overlay
- Category badges
- Price information
- Links to individual product pages
- **Two prominent tracking buttons:**
  - "Recently Visited (Last 5)" - Blue button
  - "Most Visited (Top 5)" - Yellow/Warning button

### Individual Product Page (`/products/show?id=X`)

**Features:**
- Breadcrumb navigation
- Large product image
- Detailed description
- Key features list (8 items per product)
- Technologies used (badges)
- Related products (same category)
- Call-to-action buttons
- Link to recently visited products

**Cookie Behavior:**
- Automatically tracks visit when page loads
- Updates both `recently_visited` and `visit_counts` cookies
- No user action required

### Recently Visited Page (`/products/recently-visited`)

**Features:**
- Shows last 5 visited products in chronological order
- Card layout with images
- "Visited" badge on each product
- Empty state if no products visited yet
- Link to "Most Visited" page
- Info box explaining cookie tracking

**Display Logic:**
- Reads `recently_visited` cookie
- Shows products in order (most recent first)
- If cookie doesn't exist or is empty, shows empty state

### Most Visited Page (`/products/most-visited`) - Extra Credit

**Features:**
- Shows top 5 most visited products
- Ranked badges (#1 gold, #2 silver, #3 bronze, #4-5 purple)
- Visit count display on each card
- Progress bar showing relative popularity
- Statistics summary (total visits, top product visits, tracked count)
- Animated fire icon
- "Extra Credit Feature" badge
- Info box explaining visit counting

**Display Logic:**
- Reads `visit_counts` cookie
- Sorts products by visit count (descending)
- Shows top 5 with rankings
- Calculates statistics

---

## 🧪 Testing Instructions

### Test Scenario 1: Recently Visited Tracking

1. **Start fresh:**
   ```bash
   # Clear cookies or open incognito window
   ```

2. **Visit products page:**
   ```
   http://localhost:8000/company/products
   ```

3. **Click on 5 different products** (e.g., IDs 1, 3, 5, 7, 9)

4. **Check "Recently Visited":**
   ```
   http://localhost:8000/products/recently-visited
   ```
   - Should show products 9, 7, 5, 3, 1 (reverse chronological order)

5. **Visit product 1 again:**
   ```
   http://localhost:8000/products/show?id=1
   ```

6. **Check "Recently Visited" again:**
   - Product 1 should now be first
   - Order should be: 1, 9, 7, 5, 3

7. **Visit 6th product (e.g., ID 2):**
   - Check "Recently Visited"
   - Should show only 5 products: 2, 1, 9, 7, 5
   - Product 3 should be removed (oldest)

### Test Scenario 2: Most Visited Tracking (Extra Credit)

1. **Visit product 1** three times
2. **Visit product 3** five times
3. **Visit product 7** twice
4. **Visit product 2** once
5. **Visit product 10** four times

6. **Check "Most Visited":**
   ```
   http://localhost:8000/products/most-visited
   ```
   - Ranking should be:
     - #1: Product 3 (5 visits)
     - #2: Product 10 (4 visits)
     - #3: Product 1 (3 visits)
     - #4: Product 7 (2 visits)
     - #5: Product 2 (1 visit)

### Test Scenario 3: Cookie Persistence

1. Visit several products
2. Close browser (but don't clear cookies)
3. Reopen browser
4. Go to "Recently Visited" or "Most Visited"
5. Data should still be there (cookies last 30 days)

### Test Scenario 4: Empty States

1. **Clear all cookies**
2. **Visit "Recently Visited":**
   - Should show empty state message
   - "Browse Products" button should appear

3. **Visit "Most Visited":**
   - Should show empty state message
   - "Browse Products" button should appear

---

## 🔍 Cookie Details

### Cookie Parameters

```php
setcookie(
    'cookie_name',           // Name
    $value,                  // JSON-encoded data
    time() + (30*24*60*60), // Expires in 30 days
    '/'                      // Path (site-wide)
);
```

### Cookie Sizes

- **recently_visited:** ~50 bytes (array of 5 integers)
- **visit_counts:** ~100-200 bytes (depends on products visited)
- **Total:** < 300 bytes (well under 4KB cookie limit)

### Security Considerations

✅ **Current Implementation:**
- HttpOnly: Not set (cookies accessible via JavaScript)
- Secure: Not set (works on HTTP and HTTPS)
- SameSite: Default (Lax)
- Path: "/" (site-wide access)
- Expiration: 30 days

⚠️ **Production Recommendations:**
```php
setcookie('recently_visited', $value, [
    'expires' => time() + (30 * 24 * 60 * 60),
    'path' => '/',
    'domain' => '',
    'secure' => true,      // HTTPS only
    'httponly' => true,    // Not accessible via JavaScript
    'samesite' => 'Strict' // CSRF protection
]);
```

---

## 📊 Data Flow Diagram

```
User visits /products/show?id=3
         ↓
ProductController::show()
         ↓
trackProductVisit(3)
         ↓
┌─────────────────────────────────┐
│  Recently Visited Cookie        │
│  Read: [1, 5, 7, 2]            │
│  Process: Remove 3 if exists    │
│  Add: Prepend 3 to array       │
│  Limit: Keep first 5           │
│  Write: [3, 1, 5, 7, 2]        │
└─────────────────────────────────┘
         ↓
┌─────────────────────────────────┐
│  Visit Counts Cookie            │
│  Read: {"1":2, "3":1, "5":3}   │
│  Process: Increment count for 3 │
│  Write: {"1":2, "3":2, "5":3}  │
└─────────────────────────────────┘
         ↓
Display product page
```

---

## 🎓 Homework Compliance Checklist

### ✅ Core Requirements

1. **"Modify the Products/Services section and add ten products/services"**
   - ✅ Created 10 comprehensive products
   - ✅ Each with unique ID, name, category, features, technologies

2. **"Each product/service should have their own page with descriptions and pictures"**
   - ✅ Individual page route: `/products/show?id={1-10}`
   - ✅ Detailed descriptions (2-3 paragraphs)
   - ✅ High-quality images from Unsplash
   - ✅ 8+ features per product
   - ✅ Technologies list
   - ✅ Related products section

3. **"Use web cookies technologies to track the last five previously visited products"**
   - ✅ Cookie name: `recently_visited`
   - ✅ Stores array of last 5 product IDs
   - ✅ JSON format
   - ✅ 30-day expiration
   - ✅ Automatic tracking on product view

4. **"Add a link in the Products/Services section to show the last five previously visited products"**
   - ✅ Button on `/company/products`: "Recently Visited (Last 5)"
   - ✅ Links to: `/products/recently-visited`
   - ✅ Displays last 5 visited products in chronological order
   - ✅ Shows empty state if none visited

### ✅ Extra Credit

5. **"Can you use web cookies to keep track of the five most visited products?"**
   - ✅ Cookie name: `visit_counts`
   - ✅ Stores object mapping product ID → visit count
   - ✅ Increments counter on each visit
   - ✅ Persists for 30 days

6. **"Add a link to show five most visited products to get credit"**
   - ✅ Button on `/company/products`: "Most Visited (Top 5)"
   - ✅ Links to: `/products/most-visited`
   - ✅ Displays top 5 products ranked by visit count
   - ✅ Shows rankings (#1-#5 with special styling)
   - ✅ Displays visit counts
   - ✅ Shows statistics summary

---

## 🚀 How to Test

```bash
# 1. Start PHP server
cd public
php -S localhost:8000

# 2. Open browser and test:
# Visit: http://localhost:8000/company/products

# 3. Test Recently Visited:
# - Click on different products (at least 5)
# - Click "Recently Visited (Last 5)" button
# - Verify products appear in reverse chronological order

# 4. Test Most Visited (Extra Credit):
# - Visit some products multiple times
# - Click "Most Visited (Top 5)" button
# - Verify products are ranked by visit count

# 5. Test Cookies:
# - Open browser DevTools → Application → Cookies
# - Look for "recently_visited" and "visit_counts"
# - Verify JSON data

# 6. Test Persistence:
# - Close browser (don't clear cookies)
# - Reopen and check tracking pages
# - Data should still be there
```

---

## 📸 Screenshots Guide

Recommended screenshots for homework submission:

1. **Products listing page** showing all 10 products
2. **Tracking buttons** highlighted (Recently Visited & Most Visited)
3. **Individual product page** (any product)
4. **Recently Visited page** with 5 products
5. **Most Visited page** with rankings and counts
6. **Browser DevTools** showing cookies (`recently_visited` and `visit_counts`)
7. **Empty states** (clear cookies and show empty messages)

---

## 💡 Key Learning Points

### Web Cookies Concepts Demonstrated

1. **Setting Cookies:** `setcookie()` function with parameters
2. **Reading Cookies:** `$_COOKIE` superglobal
3. **Data Serialization:** JSON encode/decode for complex data
4. **Cookie Expiration:** Time-based expiration (30 days)
5. **Cookie Path:** Site-wide availability with '/'
6. **Data Structures:** Arrays and objects in cookies
7. **Client-Side Storage:** Browser-based persistence

### PHP Concepts Used

- Controller methods
- Cookie manipulation
- Array operations (array_filter, array_slice, arsort)
- JSON encoding/decoding
- Query parameters (?id=X)
- View rendering
- Data passing to views

### Best Practices Followed

✅ Cookie size optimization (< 300 bytes)
✅ Proper expiration time (30 days)
✅ JSON serialization for structured data
✅ Graceful degradation (empty states)
✅ User-friendly interfaces
✅ Clear visual feedback

---

## 🔗 Quick Links

| Feature | URL | Description |
|---------|-----|-------------|
| Products Listing | `/company/products` | View all 10 products |
| Individual Product | `/products/show?id=1` | View product #1 details |
| Recently Visited | `/products/recently-visited` | Last 5 visited products |
| Most Visited | `/products/most-visited` | Top 5 most visited (Extra) |

---

## 📝 Author

**Lambert Nguyen**  
CMPE 272 - Enterprise Software Platforms  
San José State University  
October 2025

---

*This implementation fulfills all requirements of the "Tracking with Web Cookies" lab assignment, including extra credit features.*
