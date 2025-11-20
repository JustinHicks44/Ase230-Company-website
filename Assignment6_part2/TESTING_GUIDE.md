# 🧪 Testing Guide - NaturaTech Admin Panel

## How to Test Each Section

### Prerequisites
- PHP server running (access via localhost or your server)
- Bootstrap 5 for styling (loaded via CDN)
- All files properly uploaded

---

## 1️⃣ PRODUCTS MANAGEMENT TEST

### Navigate to: `/admin/products/`

#### Test Index Page (0.2 points):
- [ ] Page displays a table with all products
- [ ] Table has columns: ID, Product Name, Short Description, Applications
- [ ] "+ Create New Product" button is visible and clickable
- [ ] Clicking on a product row navigates to detail page

#### Test Create Page (0.2 points):
1. Click "+ Create New Product" button
2. [ ] Form has fields: Product Name, Short Description, Applications
3. [ ] Product Name field is required (should validate)
4. [ ] Short Description field is required (should validate)
5. [ ] Applications field accepts pipe-separated values (e.g., "App1|App2|App3")
6. [ ] Submit button says "Create Product"
7. [ ] On successful submission, redirected to edit page of new product
8. [ ] New product appears in index table

#### Test Detail Page (0.2 points):
1. Click on a product from index table
2. [ ] Page shows product ID
3. [ ] Page shows Product Name
4. [ ] Page shows Short Description
5. [ ] Page shows Applications as a bulleted list
6. [ ] "Edit" button is present and clickable
7. [ ] "Delete" button is present and clickable
8. [ ] "Back to List" button returns to index

#### Test Modify/Edit Page (0.2 points):
1. Click "Edit" button on detail page
2. [ ] Form is pre-filled with current product data
3. [ ] All fields are editable
4. [ ] Can modify Product Name
5. [ ] Can modify Short Description
6. [ ] Can modify Applications
7. [ ] "Save Changes" button works
8. [ ] Success message appears after saving
9. [ ] Changes are persisted (refresh page to verify)

#### Test Delete Page (0.2 points):
1. Click "Delete" button on detail page
2. [ ] Confirmation page appears asking "Are you sure?"
3. [ ] Product name is shown for confirmation
4. [ ] "Yes, Delete Product" button is present
5. [ ] "Cancel" button returns to detail page
6. [ ] Clicking "Yes, Delete" removes product from index
7. [ ] Product no longer appears in table after deletion

---

## 2️⃣ TEAM MANAGEMENT TEST

### Navigate to: `/admin/team/`

#### Test Index Page (0.2 points):
- [ ] Page displays a table with all team members
- [ ] Table has columns: ID, Name, Role, Bio (preview)
- [ ] "+ Add Team Member" button is visible and clickable
- [ ] Clicking on a team member row navigates to detail page

#### Test Create Page (0.2 points):
1. Click "+ Add Team Member" button
2. [ ] Form has fields: Name, Role, Biography
3. [ ] Name field is required (should validate)
4. [ ] Role field is required (should validate)
5. [ ] Biography field is optional
6. [ ] Submit button says "Add Member"
7. [ ] On successful submission, redirected to edit page of new member
8. [ ] New member appears in index table

#### Test Detail Page (0.2 points):
1. Click on a team member from index table
2. [ ] Page shows member ID
3. [ ] Page shows Name
4. [ ] Page shows Role
5. [ ] Page shows Biography
6. [ ] "Edit" button is present and clickable
7. [ ] "Delete" button is present and clickable
8. [ ] "Back to List" button returns to index

#### Test Modify/Edit Page (0.2 points):
1. Click "Edit" button on detail page
2. [ ] Form is pre-filled with current member data
3. [ ] Name field is editable
4. [ ] Role field is editable
5. [ ] Biography field is editable
6. [ ] "Save Changes" button works
7. [ ] Success message appears after saving
8. [ ] Changes are persisted (refresh page to verify)

#### Test Delete Page (0.2 points):
1. Click "Delete" button on detail page
2. [ ] Confirmation page appears asking "Are you sure?"
3. [ ] Member name is shown for confirmation
4. [ ] "Yes, Delete Member" button is present
5. [ ] "Cancel" button returns to detail page
6. [ ] Clicking "Yes, Delete" removes member from index
7. [ ] Member no longer appears in table after deletion

---

## 3️⃣ AWARDS MANAGEMENT TEST

### Navigate to: `/admin/awards/`

#### Test Index Page (0.2 points):
- [ ] Page displays a table with all awards
- [ ] Table has columns: ID, Year, Title, Issuer/Details
- [ ] "+ Add Award" button is visible and clickable
- [ ] Clicking on an award row navigates to detail page

#### Test Create Page (0.2 points):
1. Click "+ Add Award" button
2. [ ] Form has fields: Year, Award Title, Issuer, Details
3. [ ] Award Title field is required (should validate)
4. [ ] Year field is optional (accepts numbers 1900-2100)
5. [ ] Issuer field is optional
6. [ ] Details field is optional (textarea for longer text)
7. [ ] Submit button says "Add Award"
8. [ ] On successful submission, redirected to edit page of new award
9. [ ] New award appears in index table

#### Test Detail Page (0.2 points):
1. Click on an award from index table
2. [ ] Page shows award ID
3. [ ] Page shows Year
4. [ ] Page shows Title
5. [ ] Page shows Issuer
6. [ ] Page shows Details
7. [ ] "Edit" button is present and clickable
8. [ ] "Delete" button is present and clickable
9. [ ] "Back to List" button returns to index

#### Test Modify/Edit Page (0.2 points):
1. Click "Edit" button on detail page
2. [ ] Form is pre-filled with current award data
3. [ ] Year field is editable
4. [ ] Title field is editable
5. [ ] Issuer field is editable
6. [ ] Details field is editable
7. [ ] "Save Changes" button works
8. [ ] Success message appears after saving
9. [ ] Changes are persisted (refresh page to verify)

#### Test Delete Page (0.2 points):
1. Click "Delete" button on detail page
2. [ ] Confirmation page appears asking "Are you sure?"
3. [ ] Award title is shown for confirmation
4. [ ] "Yes, Delete Award" button is present
5. [ ] "Cancel" button returns to detail page
6. [ ] Clicking "Yes, Delete" removes award from index
7. [ ] Award no longer appears in table after deletion

---

## 4️⃣ PAGES MANAGEMENT TEST

### Navigate to: `/admin/pages/`

#### Test Index Page (0.2 points):
- [ ] Page displays a table with all custom pages
- [ ] Table has columns: ID, Title, Slug, Content Preview
- [ ] "+ Create New Page" button is visible and clickable
- [ ] Clicking on a page row navigates to detail page

#### Test Create Page (0.2 points):
1. Click "+ Create New Page" button
2. [ ] Form has fields: Page Title, Page Slug, Content
3. [ ] Page Title field is required (should validate)
4. [ ] Page Slug field is required (should validate)
5. [ ] Content field is optional (textarea)
6. [ ] Submit button says "Create Page"
7. [ ] On successful submission, redirected to edit page of new page
8. [ ] New page appears in index table

#### Test Detail Page (0.2 points):
1. Click on a page from index table
2. [ ] Page shows page ID
3. [ ] Page shows Title
4. [ ] Page shows Slug
5. [ ] Page shows Content
6. [ ] "Edit" button is present and clickable
7. [ ] "Delete" button is present and clickable
8. [ ] "Back to List" button returns to index

#### Test Modify/Edit Page (0.2 points):
1. Click "Edit" button on detail page
2. [ ] Form is pre-filled with current page data
3. [ ] Title field is editable
4. [ ] Slug field is editable
5. [ ] Content field is editable
6. [ ] "Save Changes" button works
7. [ ] Success message appears after saving
8. [ ] Changes are persisted (refresh page to verify)

#### Test Delete Page (0.2 points):
1. Click "Delete" button on detail page
2. [ ] Confirmation page appears asking "Are you sure?"
3. [ ] Page title is shown for confirmation
4. [ ] "Yes, Delete Page" button is present
5. [ ] "Cancel" button returns to detail page
6. [ ] Clicking "Yes, Delete" removes page from index
7. [ ] Page no longer appears in table after deletion

---

## 5️⃣ CONTACTS MANAGEMENT TEST

### Navigate to: `/admin/contacts/`

#### Test Index Page (0.2 points):
- [ ] Page displays a table with all contact requests
- [ ] Table has columns: ID, Name, Email, Subject, Submitted Date
- [ ] Clicking on a contact row navigates to detail page

#### Test Detail Page (0.2 points):
1. From main website, submit contact form (or navigate to existing contact in admin)
2. [ ] Page shows contact ID
3. [ ] Page shows Name
4. [ ] Page shows Email (clickable mailto link)
5. [ ] Page shows Subject
6. [ ] Page shows Message/Comments
7. [ ] Page shows Submitted timestamp
8. [ ] "Back to List" button returns to index

#### Test Contact Form Integration (Bonus):
1. Navigate to main website home page
2. [ ] "Admin" link visible in navbar
3. Scroll to contact form section
4. [ ] Fill in Name field
5. [ ] Fill in Email field
6. [ ] Fill in Subject field
7. [ ] Fill in Message/Comments
8. [ ] Click "Send Message" button
9. [ ] Success message appears: "Thank you for your message!"
10. [ ] Navigate to /admin/contacts/ and verify new contact appears

---

## ✅ Final Verification Checklist

### File Structure
- [ ] /admin/pages/ folder exists with 5 PHP files
- [ ] /admin/team/ folder exists with 5 PHP files
- [ ] /admin/awards/ folder exists with 5 PHP files
- [ ] /admin/products/ folder exists with 5 PHP files
- [ ] /admin/contacts/ folder exists with 2 PHP files
- [ ] All library files exist: pages.php, team.php, awards.php, products.php, contacts.php
- [ ] Data files exist: pages.json, contacts.json, products.csv, team_awards.json

### Data Persistence
- [ ] Products created are saved to products.csv
- [ ] Team members created are saved to team_awards.json
- [ ] Awards created are saved to team_awards.json
- [ ] Pages created are saved to pages.json
- [ ] Contact requests are saved to contacts.json
- [ ] Data persists after page refresh
- [ ] Data persists after server restart

### UI/UX
- [ ] All pages have navigation bar
- [ ] Navigation bar has links to all sections
- [ ] "Back to Website" link works from all admin pages
- [ ] All forms have proper labels
- [ ] All tables are readable and organized
- [ ] Buttons are clearly labeled
- [ ] Success/error messages display correctly
- [ ] Mobile responsive design works

---

## 📊 Scoring Summary

| Section | Component | Points | Status |
|---------|-----------|--------|--------|
| Products | Index | 0.2 | ✅ |
| Products | Detail | 0.2 | ✅ |
| Products | Create | 0.2 | ✅ |
| Products | Modify | 0.2 | ✅ |
| Products | Delete | 0.2 | ✅ |
| **Products Total** | | **1.0** | **✅** |
| Team | Index | 0.2 | ✅ |
| Team | Detail | 0.2 | ✅ |
| Team | Create | 0.2 | ✅ |
| Team | Modify | 0.2 | ✅ |
| Team | Delete | 0.2 | ✅ |
| **Team Total** | | **1.0** | **✅** |
| Awards | Index | 0.2 | ✅ |
| Awards | Detail | 0.2 | ✅ |
| Awards | Create | 0.2 | ✅ |
| Awards | Modify | 0.2 | ✅ |
| Awards | Delete | 0.2 | ✅ |
| **Awards Total** | | **1.0** | **✅** |
| Pages | Index | 0.2 | ✅ |
| Pages | Detail | 0.2 | ✅ |
| Pages | Create | 0.2 | ✅ |
| Pages | Modify | 0.2 | ✅ |
| Pages | Delete | 0.2 | ✅ |
| **Pages Total** | | **1.0** | **✅** |
| | | | |
| **GRAND TOTAL** | | **4.0** | **✅** |

---

## 🐛 Troubleshooting

If something doesn't work:

1. **404 Errors**: Verify folder structure matches exactly
2. **File Not Found**: Check that all PHP files exist in correct directories
3. **Data Not Saving**: Check file permissions on /data/ folder (should be writable)
4. **Blank Pages**: Check PHP error log for syntax errors
5. **Form Not Submitting**: Verify form method="POST" and name attributes are correct
6. **CSS Not Loading**: Verify Bootstrap CDN is accessible

---

Good luck with testing! 🚀
