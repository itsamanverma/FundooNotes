# 📝 FundooNotes - Note Management API

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-9.52.21-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.3.6-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge" alt="License">
  <img src="https://img.shields.io/badge/API-REST-blue?style=for-the-badge" alt="API">
</p>

<p align="center">
A robust RESTful API for note-taking and organization built with Laravel 9. FundooNotes provides a comprehensive backend solution for creating, managing, and organizing notes with labels, user authentication, and email verification.
</p>

---

## 🚀 **Features**

### 🔐 **Authentication & User Management**
- **User Registration** with email verification
- **User Login** with JWT authentication via Laravel Passport
- **Password Reset** via email
- **Social Login** integration
- **User Profile** management
- **Email Verification** system

### 📋 **Notes Management**
- **Create Notes** with title, body, and metadata
- **Edit Notes** with full CRUD operations
- **Delete Notes** with soft delete support
- **Search Notes** by title and content
- **Note Organization** with labels and categories
- **Note Status** management (pinned, archived, trash)

### 🏷️ **Labels & Organization**
- **Create Labels** for note categorization
- **Edit & Delete Labels** with validation
- **Add/Remove Labels** to/from notes
- **Duplicate Label Prevention** per user
- **Label-Note Relationships** management

### 🔧 **Technical Features**
- **RESTful API** with OpenAPI 3.0 documentation (Swagger UI)
- **JWT Authentication** via Laravel Passport
- **Email Notifications** with SMTP configuration
- **Input Validation** with comprehensive rules
- **Error Handling** with JSON responses
- **CORS Support** for frontend integration
- **Database Relationships** with Eloquent ORM

### 🖥️ **API Endpoints**
- **Authentication**: /register, /login, /verifyemail/{token}, /forgotpassword, /forgotpassword/reset, /sociallogin
- **Notes**: /getnotes, /createnote, /editnote, /searchNotes, /deletenote
- **Labels**: /makelabel, /editlabel, /deletelabel, /addnotelabel
- **User**: /userDetails, /logout

### 🗂️ **Other Features**
- Interactive API documentation via Swagger UI
- Request/response examples and authentication testing
- Downloadable OpenAPI 3.0 specification

---

## 📊 **Tech Stack**

| Component | Technology |
|-----------|------------|
| **Backend Framework** | Laravel 9.52.21 |
| **Language** | PHP 8.3.6 |
| **Authentication** | Laravel Passport (OAuth2) |
| **Database** | MySQL/SQLite |
| **Email** | SMTP with Mailtrap/Gmail support |
| **Documentation** | Swagger/OpenAPI 3.0 |
| **Validation** | Laravel Form Requests |
| **Security** | JWT Tokens, CSRF Protection |

---

## 🛠️ **Installation & Setup**

### **Prerequisites**
- PHP 8.3+ 
- Composer 2.0+
- Node.js 16+ (optional, for frontend assets)
- MySQL 8.0+ or SQLite

### **1. Clone Repository**
```bash
git clone https://github.com/yourusername/fundoonotes.git
cd fundoonotes
```

### **2. Install Dependencies**
```bash
composer install
npm install  # Optional for frontend assets
```

### **3. Environment Configuration**
```bash
cp .env.example .env
php artisan key:generate
```

### **4. Database Setup**
```bash
# Configure database in .env file
php artisan migrate
php artisan passport:install
php artisan passport:client --personal
```

### **5. Email Configuration (Optional)**
```env
# Gmail SMTP Configuration
MAIL_DRIVER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
```

### **6. Start Development Server**
```bash
php artisan serve
# Access API: http://127.0.0.1:8000/api
# API Documentation: http://127.0.0.1:8000/api/documentation
```

---

## 📚 **API Documentation**

### **Base URL**
```
http://127.0.0.1:8000/api
```

### **Authentication Endpoints**
| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/register` | Register new user |
| `POST` | `/login` | User login |
| `GET` | `/verifyemail/{token}` | Verify email address |
| `POST` | `/forgotpassword` | Request password reset |
| `POST` | `/forgotpassword/reset` | Reset password |
| `POST` | `/sociallogin` | Social media login |

### **Notes Endpoints** (Authenticated)
| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/getnotes` | Get user's notes |
| `POST` | `/createnote` | Create new note |
| `POST` | `/editnote` | Edit existing note |
| `POST` | `/searchNotes` | Search notes by content |
| `POST` | `/deletenote` | Delete note |

### **Labels Endpoints** (Authenticated)
| Method | Endpoint | Description |
|--------|----------|-------------|
| `POST` | `/makelabel` | Create new label |
| `POST` | `/editlabel` | Edit existing label |
| `POST` | `/deletelabel` | Delete label |
| `POST` | `/addnotelabel` | Add label to note |

### **User Endpoints** (Authenticated)
| Method | Endpoint | Description |
|--------|----------|-------------|
| `GET` | `/userDetails` | Get user profile |
| `GET` | `/logout` | Logout user |

---

## 🔍 **Interactive API Documentation**

Visit the **Swagger UI** for detailed API documentation and testing:
```
http://127.0.0.1:8000/api/documentation
```

Features:
- 🧪 **Interactive Testing** - Try endpoints directly from the browser
- 📋 **Request/Response Examples** - See sample data formats
- 🔐 **Authentication Testing** - Test with JWT tokens
- 📄 **OpenAPI 3.0 Spec** - Download API specification

---

## 🗃️ **Database Schema**

### **Core Tables**
- **users** - User accounts with profile information
- **notes** - Note content with metadata (title, body, status)
- **labels** - User-defined labels for organization
- **labels_notes** - Many-to-many relationship between notes and labels
- **password_resets** - Password reset tokens
- **oauth_*** - Laravel Passport OAuth2 tables

### **Key Relationships**
```
User ──→ Notes (One-to-Many)
User ──→ Labels (One-to-Many)
Notes ←──→ Labels (Many-to-Many via labels_notes)
```

---

## 🧪 **Testing**

### **Test Email Configuration**
```bash
php artisan mail:test your-email@example.com
```

### **API Testing with cURL**
```bash
# Register User
curl -X POST http://127.0.0.1:8000/api/register \
  -H "Content-Type: application/json" \
  -d '{"firstname":"John","lastname":"Doe","email":"john@example.com","password":"password123","c_password":"password123"}'

# Login User
curl -X POST http://127.0.0.1:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"john@example.com","password":"password123"}'
```

---

## 🔧 **Configuration**

### **Key Configuration Files**
- `config/app.php` - Application settings
- `config/auth.php` - Authentication configuration
- `config/mail.php` - Email service settings
- `config/l5-swagger.php` - API documentation settings

### **Important Environment Variables**
```env
APP_NAME=FundooNotes
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_DATABASE=fundoonotes

MAIL_DRIVER=smtp
L5_SWAGGER_GENERATE_ALWAYS=true
```

---

## 🚀 **Deployment**

### **Production Checklist**
- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Configure production database
- [ ] Set up SMTP email service
- [ ] Configure proper CORS settings
- [ ] Set up SSL/HTTPS
- [ ] Run `php artisan config:cache`
- [ ] Run `php artisan route:cache`

---

## 🤝 **Contributing**

1. **Fork** the repository
2. **Create** a feature branch (`git checkout -b feature/amazing-feature`)
3. **Commit** your changes (`git commit -m 'Add amazing feature'`)
4. **Push** to the branch (`git push origin feature/amazing-feature`)
5. **Open** a Pull Request

---

## 📄 **License**

This project is licensed under the **MIT License** - see the [LICENSE](LICENSE) file for details.

---

## 📞 **Support**

- 📧 **Email**: amanvermame786@gmail.com
- 📖 **Documentation**: [Swagger API Docs](http://127.0.0.1:8000/api/documentation)
- 🐛 **Issues**: [GitHub Issues](https://github.com/yourusername/fundoonotes/issues)

---

<p align="center">
  <strong>Built with ❤️ using Laravel 9 & PHP 8.3</strong>
</p>
