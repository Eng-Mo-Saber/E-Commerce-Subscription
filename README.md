# E-Commerce Subscription System

A hybrid **E-Commerce and Subscription platform** built with **Laravel (PHP)**.  
The system supports one-time product sales and recurring subscriptions, with full integration of **Kashier Payment Gateway**.  
It also provides an **Admin Dashboard** for managing products, users, and payments, along with background job processing and RESTful APIs for external integrations.

---

## 🚀 Features

- **Product Sales** – One-time purchase support  
- **Recurring Subscriptions** – Automated billing using Kashier  
- **Kashier Payment Integration** – Supports both one-time & recurring payments  
- **Image Uploads** – Upload and manage product/user images  
- **RESTful APIs** – For mobile apps or external services  
- **Admin Dashboard** – Manage products, subscriptions, users, and payments  
- **Background Processing** – Jobs, Queues, and Scheduler for heavy/recurring tasks  
- **Deployed on Hosting Server** – Ready for production use  

---

## 🛠️ Tech Stack

- **Backend:** PHP (Laravel)  
- **Database:** MySQL  
- **Payments:** Kashier API  
- **Background Jobs:** Laravel Jobs, Queues, Scheduler  
- **Deployment:** Shared Hosting / Production Server  

---

## ⚙️ Installation & Setup

1. Clone the repository:
   ```bash
   git clone https://github.com/Eng-Mo-Saber/E-Commerce-Subscription.git
   cd E-Commerce-Subscription
2. Install dependencies:
    composer install
    npm install && npm run dev
3. Configure environment variables:
    Copy .env.example → .env
    Set up database credentials
    Add Kashier API keys
4. Run migrations & seeders:
    php artisan migrate --seed
5. Start Laravel server:
    php artisan serve
6. Run queue worker (for background jobs):
    php artisan queue:work
7. Setup Laravel Scheduler (cron job on server):
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

## 📊 Dashboard
Manage products, users, subscriptions, and payments
Monitor system activities and reports

## 📌 API Endpoints (Example)
POST /api/products → Create new product
GET /api/products → Fetch all products
POST /api/subscribe → Create a subscription
POST /api/payment/checkout → Kashier checkout