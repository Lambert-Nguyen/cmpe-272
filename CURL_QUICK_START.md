# Combined Users CURL Lab - Quick Start

## 🚀 Quick Setup (5 Minutes)

### ✅ What's Already Done
- CombinedUsersController created
- Combined users view created
- Routes configured
- API endpoint ready
- Navbar link added

### 📝 What You Need to Do

#### Step 1: Get Partner URLs from Your Group
Ask your 1-2 partners for their API endpoints:
```
Partner 1: https://their-domain.com/api/users
Partner 2: https://another-domain.com/api/users
```

#### Step 2: Add Partner URLs
Edit `src/Controllers/CombinedUsersController.php` (line 16):

```php
private $partnerCompanies = [
    'Partner Company B' => 'https://partner-b.com/api/users',
    'Partner Company C' => 'https://partner-c.com/api/users',
];
```

#### Step 3: Share Your API URL
Give this to your partners:
```
https://lambertnguyen.cloud/api/users
```

#### Step 4: Test Everything
1. **Test your API:** https://lambertnguyen.cloud/api/users
2. **Test combined page:** https://lambertnguyen.cloud/combined-users
3. **Test partner connection:**
   ```
   https://lambertnguyen.cloud/test-connection?url=https://partner.com/api/users
   ```

## 🎯 Key URLs

| Purpose | URL |
|---------|-----|
| Combined Users Page | `/combined-users` |
| Your API Endpoint | `/api/users` |
| Test Partner API | `/test-connection?url=...` |

## 🧪 Testing Checklist

- [ ] Your API returns JSON with users
- [ ] Combined users page shows your 15 local users
- [ ] Partner URLs added to controller
- [ ] Partner connections successful
- [ ] Error handling works (test with bad URL)
- [ ] All user data displays correctly

## 📊 Expected Results

### Your API Response
```json
{
  "success": true,
  "company": "Lambert Nguyen Company",
  "count": 15,
  "users": [...]
}
```

### Combined Users Page Shows
- Statistics: Total Companies, Active Connections, Combined Users
- Lambert Nguyen Company section (15 users)
- Partner company sections (if configured)
- Status badges for each company

## 🐛 Quick Troubleshooting

**Problem:** Partner API not working  
**Solution:** Use `/test-connection?url=...` to diagnose

**Problem:** No users showing  
**Solution:** Check `database/users.txt` exists

**Problem:** JSON error  
**Solution:** Verify partner API returns valid JSON

## 📧 Quick Email Template

```
Subject: CMPE 272 - Combined Users CURL Lab Submission

Hi Prof. Sinn,

I've completed the Combined Users CURL Lab (October 30, 2025).

Deployed URL: https://lambertnguyen.cloud

Test URLs:
- Combined Users: https://lambertnguyen.cloud/combined-users
- API Endpoint: https://lambertnguyen.cloud/api/users

Group Members:
- Lambert Nguyen (https://lambertnguyen.cloud)
- [Partner 1 Name] ([Partner 1 URL])
- [Partner 2 Name] ([Partner 2 URL])

Implementation:
- PHP CURL to fetch remote users
- API endpoint for partners to access our users
- Combined display of all users from all companies
- Error handling for failed connections

Best regards,
Lambert Nguyen
```

## 🎓 Implementation Summary

**What This Lab Does:**
1. Fetches local users from `database/users.txt`
2. Uses CURL to fetch users from partner APIs
3. Combines all users into single page
4. Provides API endpoint for partners
5. Handles errors gracefully

**Key Technologies:**
- PHP CURL for HTTP requests
- JSON API design
- REST endpoints
- Error handling
- CORS headers

**Files Modified/Created:**
- ✅ `src/Controllers/CombinedUsersController.php` (NEW)
- ✅ `src/Views/combined-users/index.php` (NEW)
- ✅ `public/index.php` (Updated routes)
- ✅ `src/Views/layouts/main.php` (Updated navbar)
- ✅ `database/users.txt` (Existing)

## 🔗 Related Documentation

- Full documentation: `CURL_LAB_README.md`
- Cookie tracking lab: `COOKIES_LAB_README.md`
- Admin section guide: `ADMIN_QUICK_START.md`

---

That's it! You're ready to test the Combined Users CURL Lab. 🎉
