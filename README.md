
# 🌟 Cherrish Homes – Orphanage Management System

Cherrish Homes is a dynamic portal that bridges individuals with orphanages and NGOs, enabling them to connect through volunteering, sponsoring, or donating. It is built using **PHP for the core platform** and **Flask (Python) for the chatbot**.

---

## 🔧 Features

- 🧒 Child Gallery (Sponsored & Unsponsored)
- 📝 Donation Forms
- 💬 Feedback and Newsletter
- 📷 Photo Gallery
- 🤖 Flask-based Chatbot Integration
- 🔐 User Login & Signup
- 🎁 Gift and Program Management

---

## 🖥️ Requirements

### 🧱 Backend

- [XAMPP](https://www.apachefriends.org/index.html) (Apache + MySQL for PHP)
- Python 3.8+
- Flask (`pip install flask`)
- pymysql (`pip install pymysql`)

---

## 📂 Installation Guide

### 💡 Step 1: PHP Setup with XAMPP

1. **Download & Install XAMPP.**
2. **Place the `CherishHome/` folder inside `C:/xampp/htdocs/`.**
3. **Start Apache and MySQL** using the XAMPP control panel.
4. **Create a MySQL Database:**
   - Go to [http://localhost/phpmyadmin](http://localhost/phpmyadmin)
   - Create a database named `cherrish_db` (or update `db-connection.php` to match your DB name).

5. **Import the SQL File** (if provided) via phpMyAdmin.

6. **Run the PHP Website:**
   ```
   http://localhost/CherishHome/
   ```

---

### 🤖 Step 2: Flask Chatbot Setup

1. Open terminal / command prompt and navigate to the chatbot folder (if it’s outside `htdocs`).

2. Create a virtual environment (optional but recommended):
   ```bash
   python -m venv venv
   source venv/bin/activate  # On Windows: venv\Scripts\activate
   ```

3. Install required packages:
   ```bash
   pip install flask pymysql
   ```

4. Run the Flask App:
   ```bash
   python app.py
   ```

5. Your chatbot should run at:
   ```
   http://127.0.0.1:5000/
   ```

6. You can embed or call this Flask bot from PHP via Ajax, iframe, or fetch.

---

## 🔑 Project Structure

```
CherishHome/
├── index.php
├── login.php / signup.php
├── child-gallery-sponsored.php
├── donation-form.php
├── db-connection.php
├── feedback-form.php
├── Flask chatbot/ (optional path - adjust as needed)
└── ...
```

---

## ✨ Future Enhancements

- Add sentiment analysis to prevent misuse.
- OTP Verification for secure logins.
- API Integration for NGO listings.
- NLP Integration for better responses to users,
---

## 📬 Contact

For queries or contributions, feel free to reach out:

📧 **adityapilaniaoffic@gmail.com**  
🔗 [LinkedIn](www.linkedin.com/in/aditya-pilania-24o2)  



