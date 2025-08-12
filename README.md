# Blog with CMS using Filament Admin Panel and Laravel

A modern blog management system built using **Laravel** and powered by the **Filament** admin panel. This project allows administrators to manage blog content through a user-friendly dashboard, while visitors can view blog posts on the frontend.

---

## ✨ Features

* Create, edit, and delete blog posts
* Admin panel using Filament
* Category and tag management
* Image upload with storage support
* SEO-friendly URLs
* User authentication (admin/user roles)
* Responsive frontend layout
* Post publishing status (draft/published)
* Created and updated timestamps
* ⚙️ Powered by [Firefly Blog plugin](https://filamentphp.com/plugins/firefly-blog)

---

# My Awesome Blog Admin Panel

Here's a look at the Filament admin panel:

![Filament Admin Panel Dashboard](/public/images/image-example.png)

This is where you manage your posts, categories, and tags.

---

## 🛠️ Tech Stack

* **Framework:** Laravel 12
* **Admin Panel:** Filament PHP v3.3
* **Frontend:** Blade Templates + TailwindCSS
* **Database:** SQLite (configurable to MySQL/PostgreSQL)
* **Authentication:** Laravel Auth + Filament
* **Blog Engine:** Firefly Blog Plugin v2.0
* **Rich Text:** TipTap Editor
* **UI Components:** Livewire + Alpine.js
* **Asset Building:** Vite
* **Storage:** Laravel Filesystem

---

## 📚 Documentation

For detailed information about how the system works:

* **[Technical Overview](TECHNICAL_OVERVIEW.md)** - Architecture, code structure, and integration details for developers
* **[User Guide](USER_GUIDE.md)** - Complete guide for admins and end users
* **[Installation Guide](#installation)** - Setup instructions (see below)

---

## Installation

1.  **Clone the project:**

    ```bash
    git clone <repository_url> # Replace <repository_url> with the actual URL
    cd blog-filament-firefly
    ```

2.  **Install dependencies:**

    ```bash
    composer install
    ```

3.  **Copy .env file and configure:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Run migrations:**

    ```bash
    php artisan migrate
    ```

5.  **Install Filament:**

    ```bash
    composer require filament/filament:"^3.3" -W
    php artisan filament:install --panels
    ```

6.  **Create a user:**

    ```bash
    php artisan make:filament-user
    ```

7.  **Install Firefly Blog Plugin:** Follow the guide on the [Firefly Blog plugin page](https://filamentphp.com/plugins/firefly-blog).

8.  **Run the application:**

    ```bash
    php artisan serve
    ```

9.  **Access:**

    * **Frontend:** `http://localhost:8000`
    * **Admin Panel:** `http://localhost:8000/admin`

---

---

## 🏗️ How It Works

### System Architecture

This blog system is built with a modern, layered architecture that separates concerns and provides a clean, maintainable codebase:

```
┌─────────────────┐    ┌─────────────────┐    ┌─────────────────┐
│   Frontend      │    │  Admin Panel    │    │   Database      │
│   (Blade Views) │    │   (Filament)    │    │   (SQLite)      │
├─────────────────┤    ├─────────────────┤    ├─────────────────┤
│ • Blog Posts    │◄──►│ • Content Mgmt  │◄──►│ • Posts         │
│ • Categories    │    │ • User Mgmt     │    │ • Categories    │
│ • Comments      │    │ • Media Upload  │    │ • Tags          │
│ • User Profiles │    │ • SEO Settings  │    │ • Comments      │
└─────────────────┘    └─────────────────┘    └─────────────────┘
        ▲                        ▲                        ▲
        │                        │                        │
        └──────────────── Laravel Framework ──────────────┘
```

### Key Components

#### 1. **Laravel Framework** (Backend Foundation)
- **Routes**: Handles URL routing, with main blog routes under `/blog` prefix
- **Models**: Eloquent ORM models for data management
- **Middleware**: Authentication and web security
- **Service Providers**: Bootstrap application services

#### 2. **Filament Admin Panel** (Content Management)
- **Dashboard**: Centralized admin interface at `/admin`
- **Resources**: CRUD operations for all content types
- **Forms**: Rich form builder for content creation/editing
- **Tables**: Data listing with search, filter, and pagination
- **Widgets**: Statistics and quick actions dashboard

#### 3. **Firefly Blog Plugin** (Blog Functionality)
- **Post Management**: Create, edit, publish, and schedule posts
- **Category System**: Organize content by categories
- **Tag System**: Tag posts for better discoverability
- **Comment System**: User engagement through comments
- **SEO Features**: Meta tags, slugs, and search optimization

#### 4. **User Management**
- **Authentication**: Laravel's built-in auth system
- **Roles**: Admin/user role separation
- **Profiles**: User profiles with avatars and descriptions
- **Social Links**: LinkedIn integration for author profiles

### Data Flow

#### Content Creation Workflow:
```
Admin Login → Filament Dashboard → Create Post → Add Content → 
Set Categories/Tags → Upload Images → Publish → Frontend Display
```

#### User Interaction Workflow:
```
Visit Blog → Browse Posts → Read Article → Leave Comment → 
View Author Profile → Browse Related Posts
```

### Database Structure

The system uses a well-organized database schema with the `fblog_` prefix:

- **fblog_posts**: Blog post content, metadata, and publishing status
- **fblog_categories**: Post categorization
- **fblog_tags**: Tagging system for posts
- **fblog_comments**: User comments and discussions
- **users**: User accounts and profiles

### Technical Integration

#### Frontend Integration:
- **Blade Templates**: Server-side rendered views in `resources/views/vendor/filament-blog/`
- **Livewire Components**: Interactive UI components for dynamic features
- **TailwindCSS**: Utility-first CSS framework for styling
- **Vite**: Asset bundling and development server

#### Admin Integration:
- **Filament Resources**: Auto-generated admin interfaces in `app/Filament/Resources/`
- **Form Builder**: Dynamic form generation for content management
- **Table Builder**: Automatic data tables with sorting and filtering
- **File Upload**: Image management with automatic resizing

#### Blog Plugin Integration:
- **HasBlog Trait**: Added to User model for blog functionality
- **Configuration**: Customizable settings in `config/filamentblog.php`
- **Routes**: Automatic route registration under `/blog` prefix
- **Views**: Customizable blog templates

### Key Features Explained

#### 1. **Content Management**
- Rich text editor with image support
- Draft/publish status management
- SEO-friendly URL generation
- Automatic excerpt generation

#### 2. **User Experience**
- Responsive design for all devices
- Fast loading with optimized assets
- Search functionality across content
- Category and tag browsing

#### 3. **Admin Experience**
- Intuitive dashboard with statistics
- Bulk operations for efficiency
- Media library management
- User and permission management

#### 4. **Developer Experience**
- Clean, extensible architecture
- Well-documented configuration
- Easy customization options
- Comprehensive error handling

### Configuration Options

The system is highly configurable through `config/filamentblog.php`:

- **Route Configuration**: Customize URL structure and middleware
- **User Model**: Configure user relationships and columns
- **SEO Settings**: Default meta tags and descriptions
- **Security**: reCAPTCHA integration options

---

## Notes

* I used this project to help me understand how Filament works. After learning the basics, I customized it to fit my needs. This hands-on method was how I learned.
* Learning is always free — but it takes passion and persistence. Never give up.