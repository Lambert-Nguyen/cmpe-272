# 🍪 Cookie Tracking Lab - Quick Start

## ✅ What Was Implemented

### Core Features
✅ **10 Products** with individual pages, images, and detailed descriptions  
✅ **Cookie Tracking** for last 5 visited products  
✅ **Recently Visited Page** showing your browsing history  

### Extra Credit ⭐
✅ **Visit Counter** tracking how many times you view each product  
✅ **Most Visited Page** showing your top 5 products by visit count  

---

## 🚀 Quick Test

```bash
# Start server
cd /Users/duylam1407/Workspace/SJSU/cmpe-272/public
php -S localhost:8000

# Open browser
http://localhost:8000/company/products
```

---

## 📋 Test Steps

### 1. View the Products
- Visit http://localhost:8000/company/products
- You'll see **10 products** in a grid
- Two buttons at the top:
  - 🕐 **Recently Visited (Last 5)** - Blue button
  - 🔥 **Most Visited (Top 5)** - Yellow button

### 2. Click on Products
- Click on **5 different products** to view their details
- Each click is automatically tracked in cookies
- No need to do anything special!

### 3. Check Recently Visited
- Click the **"Recently Visited"** button
- You'll see your last 5 viewed products
- Most recent is shown first

### 4. Visit Some Products Multiple Times
- Go back and click on some products again
- Visit product #1 three times
- Visit product #3 five times
- Visit product #7 twice

### 5. Check Most Visited (Extra Credit)
- Click the **"Most Visited"** button
- You'll see your top 5 products ranked by view count
- #1 gets a **gold badge** 🥇
- #2 gets a **silver badge** 🥈
- #3 gets a **bronze badge** 🥉

### 6. Verify Cookies (Optional)
- Press **F12** to open DevTools
- Go to **Application** tab → **Cookies**
- You'll see:
  - `recently_visited`: `[3,7,1,5,2]` (last 5 product IDs)
  - `visit_counts`: `{"1":3,"3":5,"7":2}` (visit counts)

---

## 🎯 All 10 Products

1. **Custom Web Application Development** - Build modern web apps
2. **Cloud Migration & Deployment** - Move to AWS/Azure/GCP
3. **Mobile App Development** - iOS & Android apps
4. **AI & Machine Learning Solutions** - Intelligent automation
5. **Enterprise Resource Planning (ERP)** - Business management systems
6. **E-Commerce Platform Development** - Online stores
7. **Cybersecurity & Penetration Testing** - Security services
8. **DevOps & CI/CD Implementation** - Automated deployments
9. **Data Analytics & Business Intelligence** - Data insights
10. **API Development & Integration** - Connect your systems

---

## 🍪 How Cookies Work

### Recently Visited Cookie
```json
Cookie: recently_visited = [3, 1, 7, 10, 2]
```
- Stores last 5 product IDs
- Most recent first
- Automatically updates when you view a product
- Lasts 30 days

### Visit Counts Cookie (Extra Credit)
```json
Cookie: visit_counts = {"1": 3, "3": 5, "7": 2, "10": 1}
```
- Counts how many times you visit each product
- Increments every time you view a product
- Used to rank "Most Visited" products
- Lasts 30 days

---

## 📸 Key Pages

| Page | URL | What You'll See |
|------|-----|-----------------|
| **All Products** | `/company/products` | 10 products + tracking buttons |
| **Product Detail** | `/products/show?id=1` | Individual product page with images |
| **Recently Visited** | `/products/recently-visited` | Last 5 products you viewed |
| **Most Visited** | `/products/most-visited` | Top 5 products by view count ⭐ |

---

## ✨ Cool Features

### Product Pages Include:
- 📸 High-quality images
- 📝 Detailed descriptions
- ✅ 8+ key features
- 💻 Technologies used
- 💰 Price ranges
- 🔗 Related products

### Recently Visited Page:
- 🕐 Chronological order (newest first)
- 👁️ "Visited" badges
- 📊 Empty state if none visited
- ℹ️ Cookie explanation

### Most Visited Page (Extra):
- 🏆 Ranking badges (#1-#5)
- 📊 Visit count display
- 📈 Progress bars showing popularity
- 📉 Statistics summary
- 🔥 Animated fire icon

---

## 🧪 Test Scenarios

### Scenario 1: Basic Tracking
1. Visit 5 different products
2. Check "Recently Visited"
3. See all 5 products in reverse order

### Scenario 2: Moving Products Up
1. Visit products 1, 2, 3, 4, 5
2. Visit product 1 again
3. Check "Recently Visited"
4. Product 1 should now be **first**

### Scenario 3: Limit to 5
1. Visit 7 different products
2. Check "Recently Visited"
3. Only **last 5** should show

### Scenario 4: Visit Counting (Extra)
1. Visit product 3 five times
2. Visit product 1 three times
3. Check "Most Visited"
4. Product 3 should be **#1** (5 visits)
5. Product 1 should be **#2** (3 visits)

### Scenario 5: Cookie Persistence
1. Visit some products
2. **Close browser** (don't clear cookies)
3. **Reopen** and check tracking pages
4. Data should **still be there** (30-day expiration)

---

## 🎓 Homework Requirements ✅

### Core (Required)
✅ Modified Products section with **10 products**  
✅ Each product has **own page** with description & picture  
✅ **Cookie tracking** for last 5 visited products  
✅ **Link** to show recently visited products  

### Extra Credit ⭐
✅ Track **visit count** for each product  
✅ **Link** to show 5 most visited products  

---

## 📁 Files Changed

```
src/Controllers/ProductController.php       # NEW: Product & cookie logic
src/Views/products/show.php                 # NEW: Individual product page
src/Views/products/recently-visited.php     # NEW: Last 5 visited
src/Views/products/most-visited.php         # NEW: Top 5 by count (Extra)
src/Views/company/products.php              # UPDATED: Show all 10 products
src/Controllers/CompanyController.php       # UPDATED: Use ProductController
public/index.php                            # UPDATED: Add product routes
```

---

## 💾 Cookie Data Examples

### After visiting products 1, 3, 5:
```javascript
// Application → Cookies in DevTools
recently_visited: "[5,3,1]"           // JSON array
visit_counts: "{"1":1,"3":1,"5":1}"   // JSON object
```

### After visiting product 3 two more times:
```javascript
recently_visited: "[3,5,1]"           // Product 3 moved to front
visit_counts: "{"1":1,"3":3,"5":1}"   // Count increased to 3
```

---

## 🔗 Quick Links

- 📦 **Products**: http://localhost:8000/company/products
- 🕐 **Recently Visited**: http://localhost:8000/products/recently-visited
- 🔥 **Most Visited**: http://localhost:8000/products/most-visited
- 📖 **Full Documentation**: `COOKIES_LAB_README.md`

---

**Ready to test!** Start the server and explore the cookie tracking features. 🎉
