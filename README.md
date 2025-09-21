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

* **Framework:** Laravel 10+
* **Admin Panel:** Filament PHP
* **Frontend:** Blade (Bootstrap/TailwindCSS)
* **Database:** MySQL / SQLite
* **Authentication:** Laravel Breeze / Fortify
* **Storage:** Laravel Filesystem

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


10.  **Storage Link:**

    After running the migration, you can create a symbolic link to the storage directory by running the following command:
    
    ```bash
    php artisan storage:link
    ```
---

## Notes

* I used this project to help me understand how Filament works. After learning the basics, I customized it to fit my needs. This hands-on method was how I learned.
* Learning is always free — but it takes passion and persistence. Never give up.