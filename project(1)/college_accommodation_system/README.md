college_accommodation_system/
│
├── index.php                      # Homepage (redirect or dashboard)
├── login.php                      # Login form
├── process_login.php              # Handles login logic
├── logout.php                     # Ends session
│
├── register/                      # (Optional folder if you allow new user registration)
│   └── admin_add_user.php         # Form for admin to add user
│   └── process_add_user.php       # Handles user creation
│
├── student/                       
│   └── apply_accommodation.php    # Student fills form here
│   └── student_view_status.php    # Student views their application status
│
├── manager/
│   └── view_applications_manager.php  # Manager views + manages applications
│   └── update_status.php              # Manager approves/rejects
│
├── includes/
│   └── navbar.php                 # Top nav bar depending on user role
│   └── session_check.php         # Reusable login/session checker
│
├── database/
│   └── db_connect.php            # DB connection code
│
├── test/
│   └── test_db.php               # Quick DB check
│   └── test_hash.php             # Optional password hash tester
│
└── assets/
    ├── css/
    │   └── style.css             # All your CSS
    └── js/
        └── scripts.js           # Any JavaScript

