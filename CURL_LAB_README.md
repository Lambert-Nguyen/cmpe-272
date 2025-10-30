# Combined Users CURL Lab - Complete Guide

## 📋 Lab Overview
**Course:** CMPE 272 - Enterprise Software Platforms  
**Topic:** Multi-Company User Integration Using PHP CURL  
**Date:** October 30, 2025  
**Type:** Group Assignment (2-3 Students)

## 🎯 Lab Requirements

### Core Requirements
1. ✅ Create a combined list of users from multiple companies (group of 2-3)
2. ✅ Use PHP CURL to fetch users from partner companies
3. ✅ Each company provides an API endpoint returning JSON
4. ✅ Display all users from all companies in a single page
5. ✅ Show local users from own database

## 🏗️ Technical Implementation

### Architecture Overview
```
┌─────────────────────────────────────────────────────┐
│           Combined Users System                      │
├─────────────────────────────────────────────────────┤
│                                                       │
│  ┌──────────────┐         ┌──────────────┐         │
│  │ Local Users  │         │ Remote Users │         │
│  │  (File DB)   │         │ (CURL APIs)  │         │
│  └───────┬──────┘         └──────┬───────┘         │
│          │                        │                  │
│          ├────────────────────────┤                  │
│          │                        │                  │
│  ┌───────▼────────────────────────▼──────┐          │
│  │   CombinedUsersController            │          │
│  │   - getLocalUsers()                   │          │
│  │   - fetchUsersViaCurl()               │          │
│  │   - api() endpoint                    │          │
│  └───────────────┬───────────────────────┘          │
│                  │                                    │
│  ┌───────────────▼───────────────────────┐          │
│  │   Combined Users View                 │          │
│  │   - Statistics Cards                  │          │
│  │   - Company Sections                  │          │
│  │   - User Tables                       │          │
│  │   - Status Indicators                 │          │
│  └───────────────────────────────────────┘          │
│                                                       │
└─────────────────────────────────────────────────────┘
```

### Components Created

#### 1. CombinedUsersController.php
**Location:** `src/Controllers/CombinedUsersController.php`

**Key Methods:**
- `index()` - Main page controller
- `api()` - JSON API endpoint for partner companies
- `getLocalUsers()` - Fetch users from local database
- `getRemoteUsers()` - Fetch users from all partner companies
- `fetchUsersViaCurl($companyName, $apiUrl)` - CURL implementation
- `testConnection()` - Debug endpoint for testing partner APIs

**CURL Configuration:**
```php
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return response as string
curl_setopt($ch, CURLOPT_TIMEOUT, 10);          // 10 second timeout
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (dev only)
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'User-Agent: Lambert-Nguyen-CMPE272',
    'Accept: application/json'
]);
```

#### 2. Combined Users View
**Location:** `src/Views/combined-users/index.php`

**Features:**
- Statistics cards (Total Companies, Active Connections, Combined Users)
- Company sections with headers showing source (local/remote)
- User tables for each company
- Status badges (Success/Error)
- CURL status indicators
- Error messages for failed connections
- Technical info box explaining the system
- Responsive design with animations

#### 3. API Endpoint
**URL:** `/api/users`  
**Method:** GET  
**Response Format:**
```json
{
  "success": true,
  "company": "Lambert Nguyen Company",
  "count": 15,
  "users": [
    {
      "name": "Mary Smith",
      "email": "mary.smith@example.com",
      "role": "Premium Member",
      "status": "Active",
      "join_date": "2024-01-15"
    }
    // ... more users
  ],
  "timestamp": "2025-10-30T10:30:00+00:00"
}
```

## 📁 Files Structure

```
cmpe-272/
├── src/
│   ├── Controllers/
│   │   └── CombinedUsersController.php  ✨ NEW
│   └── Views/
│       └── combined-users/
│           └── index.php                 ✨ NEW
├── database/
│   └── users.txt                         (Existing - 15 users)
└── public/
    └── index.php                         (Updated with routes)
```

## 🔧 Configuration

### Step 1: Add Partner Company URLs
Edit `src/Controllers/CombinedUsersController.php`:

```php
private $partnerCompanies = [
    'Company B Name' => 'https://company-b-domain.com/api/users',
    'Company C Name' => 'https://company-c-domain.com/api/users',
];
```

### Step 2: Share Your API URL
Give your partners your API endpoint:
```
https://lambertnguyen.cloud/api/users
```

### Step 3: Test Partner Connections
Use the test endpoint to verify each partner API:
```
https://lambertnguyen.cloud/test-connection?url=https://partner.com/api/users
```

## 🧪 Testing Guide

### 1. Test Local API Endpoint
```bash
curl https://lambertnguyen.cloud/api/users
```

**Expected Response:**
```json
{
  "success": true,
  "company": "Lambert Nguyen Company",
  "count": 15,
  "users": [...],
  "timestamp": "2025-10-30T..."
}
```

### 2. Test Combined Users Page
**URL:** https://lambertnguyen.cloud/combined-users

**What to Check:**
- ✅ Statistics cards show correct numbers
- ✅ Local company section displays all 15 users
- ✅ Each user has name, email, role, status, join date
- ✅ Remote companies show status (success/error)
- ✅ If partner API fails, error message is displayed
- ✅ Tables are properly formatted
- ✅ Badges show correct statuses

### 3. Test Partner Connection
**URL:** https://lambertnguyen.cloud/test-connection?url=PARTNER_API_URL

Example:
```
https://lambertnguyen.cloud/test-connection?url=https://partner.com/api/users
```

**Successful Response:**
```json
{
  "test_url": "https://partner.com/api/users",
  "status": "success",
  "http_code": 200,
  "company": "Partner Company",
  "user_count": 10
}
```

**Error Response:**
```json
{
  "test_url": "https://partner.com/api/users",
  "status": "error",
  "error": "Connection timeout",
  "http_code": 0
}
```

### 4. Test Error Handling

**Scenario 1: Invalid URL**
- Update partner URL to invalid domain
- Check that combined-users page shows error badge
- Verify error message is displayed

**Scenario 2: Timeout**
- Temporarily increase timeout to 1 second
- Test with slow responding API
- Verify timeout is handled gracefully

**Scenario 3: Invalid JSON**
- Test with non-JSON API endpoint
- Verify proper error handling

## 🔍 CURL Implementation Details

### Request Flow
1. Controller calls `getRemoteUsers()`
2. For each partner in `$partnerCompanies`:
   - Call `fetchUsersViaCurl($companyName, $apiUrl)`
   - Initialize CURL with `curl_init($apiUrl)`
   - Set options: timeout, SSL, headers
   - Execute request with `curl_exec($ch)`
   - Check HTTP response code
   - Parse JSON response
   - Handle errors gracefully
   - Return company data with status

### Error Handling
- **Connection Timeout:** Returns error status with message
- **Invalid JSON:** Catches json_decode errors
- **HTTP Errors:** Checks response code (200 = success)
- **CURL Errors:** Uses `curl_error()` to get error message
- **SSL Issues:** Disabled verification for dev (enable in production)

### Security Considerations
- ✅ SSL verification disabled for development
- ⚠️ Enable `CURLOPT_SSL_VERIFYPEER` in production
- ✅ Timeout prevents hanging requests
- ✅ User-Agent header identifies source
- ✅ JSON parsing with error handling
- ✅ Htmlspecialchars for XSS prevention in view

## 📊 Data Format

### Local Users (database/users.txt)
```
Name|Email|Role|Status|Join Date
Mary Smith|mary.smith@example.com|Premium Member|Active|2024-01-15
```

### API Response Format
```json
{
  "success": true,
  "company": "Company Name",
  "count": 15,
  "users": [
    {
      "name": "User Name",
      "email": "email@example.com",
      "role": "Role",
      "status": "Active|Inactive",
      "join_date": "YYYY-MM-DD"
    }
  ],
  "timestamp": "ISO 8601 timestamp"
}
```

## 🎨 UI Features

### Statistics Cards
- **Total Companies:** Count of local + partner companies
- **Active Connections:** Number of successful CURL connections
- **Combined Users:** Total users from all companies

### Company Sections
Each company section includes:
- Company name with icon (🏠 Local, 🌐 Remote)
- Company URL (clickable link)
- Status badges (✅ Success / ❌ Error)
- User count badge
- Source indicator (Local DB / CURL)

### User Tables
- Name (bold)
- Email (clickable mailto link)
- Role badge (👑 Premium / 👤 Standard)
- Status badge (✅ Active / ❌ Inactive)
- Join date

### Styling
- Modern gradient design
- Hover animations on cards
- Responsive layout (mobile-friendly)
- AOS scroll animations
- Consistent with existing site design

## 🚀 Deployment Checklist

- [x] CombinedUsersController.php created
- [x] Combined users view created
- [x] Routes added to index.php
- [x] Navbar updated with link
- [x] API endpoint tested
- [ ] Partner URLs added to controller
- [ ] Partner connections tested
- [ ] Error handling verified
- [ ] SSL verification enabled for production
- [ ] Documentation completed

## 📧 Submission Information

**Deployed URL:** https://lambertnguyen.cloud

**Test URLs:**
- Combined Users Page: https://lambertnguyen.cloud/combined-users
- API Endpoint: https://lambertnguyen.cloud/api/users
- Test Connection: https://lambertnguyen.cloud/test-connection?url=...

**Partner Companies:**
- Company B: [Partner 1 URL]
- Company C: [Partner 2 URL]

## 🐛 Troubleshooting

### Issue: Partner API not responding
**Solution:**
1. Test partner URL with test-connection endpoint
2. Check if partner's API is accessible
3. Verify URL format is correct
4. Check timeout settings

### Issue: JSON parsing error
**Solution:**
1. Verify partner API returns valid JSON
2. Test API response with curl command
3. Check Content-Type header

### Issue: CORS errors (if testing from browser)
**Solution:**
- CORS headers are already included in API response
- Check browser console for specific errors

### Issue: No users displayed
**Solution:**
1. Check database/users.txt exists and has data
2. Verify file permissions
3. Check error logs for parsing issues

## 📚 Learning Outcomes

### PHP CURL Skills
- ✅ Initializing CURL with `curl_init()`
- ✅ Setting CURL options with `curl_setopt()`
- ✅ Executing requests with `curl_exec()`
- ✅ Error handling with `curl_error()`
- ✅ Closing connections with `curl_close()`

### REST API Design
- ✅ Creating JSON endpoints
- ✅ Setting proper HTTP headers
- ✅ Implementing CORS for cross-origin requests
- ✅ Error response formatting

### Data Integration
- ✅ Combining data from multiple sources
- ✅ Handling different data formats
- ✅ Error handling for unreliable connections
- ✅ Status tracking for remote services

## 🎓 Extra Credit Opportunities

1. **Advanced CURL Features**
   - POST requests to partner APIs
   - Authentication headers
   - Custom request headers

2. **Caching**
   - Cache remote responses for 5 minutes
   - Reduce API calls

3. **Analytics**
   - Track response times
   - Log failed connections
   - Display statistics

4. **Real-time Updates**
   - AJAX refresh of user data
   - Auto-retry failed connections

## 📝 Notes

- This implementation uses file-based user storage (users.txt)
- Partner companies must have compatible API endpoints
- SSL verification is disabled for development (enable in production)
- CURL timeout is set to 10 seconds
- Error handling is comprehensive for production use

---

**Documentation Created:** October 30, 2025  
**Last Updated:** October 30, 2025  
**Course:** CMPE 272 - Enterprise Software Platforms  
**Instructor:** Prof. Sinn
