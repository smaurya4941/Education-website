# 💼 Bizwoke (InfyJobs) - Premium Job Portal Platform

Bizwoke (built on the InfyJobs core) is a premium, feature-rich job portal application designed to bridge the gap between candidates seeking jobs and employers looking for top talent. Built with a modern tech stack (Laravel 10, Livewire 3, and Bootstrap), the platform offers a robust administrative system, custom branding support, localized content, and subscription monetizations out of the box.

---

## 🚀 Key Features

### 👤 For Candidates
- **Dynamic Profiles:** Comprehensive profile builder including skills, experience, education, marital status, and social profiles.
- **Resume Builder:** Upload and manage multiple CVs/resumes.
- **Job Search & Filters:** Search for jobs by title, category, company, location, shift, type, or career level.
- **Application Tracking:** Track the progress of job applications through custom stages defined by employers.
- **Subscription Dashboards:** Access subscription statuses and manage plans.

### 🏢 For Employers (Companies)
- **Company Branding:** Customize profile details, team size, ownership type, and company logos.
- **Job Management:** Post, edit, and deactivate jobs with granular details (salary, currency, shifts, tags, required degree).
- **Featured Postings:** Pay via integrated gateways to feature job postings or the company profile.
- **Candidate Pipeline:** Move applicants through custom stages (e.g. Applied, Shortlisted, Interviewed, Selected, Rejected).

### ⚙️ For Administrators
- **Branding & CMS Control:** Configure sliders, testimonials, FAQs, noticeboards, and front-page sections.
- **User & Role Management:** Fine-grained access control using Spatie Roles and Permissions.
- **Translation Manager:** Translate frontend and backend interface strings into multiple languages.
- **Transaction Logs:** Track stripe, PayPal, and Paystack payments for subscription packages.
- **System Diagnostics:** Access log viewers and global environment configurations directly from the admin panel.

---

## 🛠️ Technology Stack

| Component | Technology | Description |
| :--- | :--- | :--- |
| **Backend Framework** | Laravel 10.x | Modern, secure PHP framework |
| **PHP Version** | PHP >= 8.2 | Fast execution and modern language features |
| **Frontend Reactive Logic**| Livewire 3.x & AlpineJS | Dynamic, reactive interfaces without leaving Laravel |
| **Styling & Theme** | Bootstrap 4 & Vanilla CSS | Modular styling, responsive grids, custom corporate theme |
| **Database** | MySQL | Reliable relational database |
| **Payments** | Laravel Cashier (Stripe), PayPal, Paystack | Subscription payments and monetization |
| **Assets Compiler** | Webpack Mix | Quick assets compilation |

---

## 📦 Prerequisites

Before setting up the project locally, ensure you have the following installed:
- **PHP** (8.2 or higher)
- **Composer** (2.x)
- **Node.js** (v16+ recommended) & **npm**
- **MySQL** (5.7 or higher / MariaDB 10.3+)
- **Git**

---

## ⚙️ Quick Setup Guide

Follow these steps to set up the project on your local machine:

### 1. Clone the Repository
```bash
git clone <repository-url>
cd jobs
```

### 2. Configure Environment Variables
Copy the template `.env` file and generate the application encryption key:
```bash
cp .env.example .env
php artisan key:generate
```

Open `.env` in your editor and configure your database and mail credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Optional: Config Stripe / Paypal / Paystack / Social Logins if needed
```

### 3. Install Dependencies
Install PHP dependencies via Composer and frontend packages via npm:
```bash
composer install
npm install
```

### 4. Database Setup & Migrations
You can set up the database in one of two ways:

#### Option A: Import Pre-configured SQL Dump (Recommended)
This installs seed data, sample companies, candidates, and portal settings.
1. Create a database in MySQL matching your `.env` settings.
2. Import the SQL file located in the project directory:
   ```bash
   mysql -u your_database_user -p your_database_name < database/infy-jobs.sql
   ```

#### Option B: Run Migrations & Seeds
Alternatively, you can run migrations and seed the database using Laravel's Artisan command:
```bash
php artisan migrate --seed
```

### 5. Build Assets
Compile the assets for development or production:
```bash
# For development
npm run dev

# For production/build
npm run prod
```

### 6. Run the Application
Start the local development server:
```bash
php artisan serve
```
Your application will be available at `http://127.0.0.1:8000`.

---

## 📂 Project Structure

A quick overview of key directories:
- `app/Http/Controllers`: Contains Controllers handling HTTP requests (web & API).
- `app/Models`: Contains Eloquent models (e.g. Job, Candidate, Company, Plan).
- `database/migrations` & `seeders`: Files for creating schema tables and populating database.
- `resources/views`: Laravel blade files organizing layouts, admin sections, candidate/employer portals, and frontend themes.
- `routes/web.php`: Primary routes file defining authentication, portal routing, and payment callbacks.

---

## 🤝 Commit Rules

To keep the repository clean and history searchable, we follow standard **Conventional Commits**:

Format: `<type>([scope]): <description>`

- Wrap lines at **72 characters**.
- Example: `feat(users): add candidate resume download button`

### Commit Types:
- `feat`: A new feature
- `fix`: A bug fix
- `refactor`: Code restructuring without modifying functionality
- `style`: Visual style updates (CSS, HTML tweaks)
- `docs`: Documentation updates (README, wikis)
- `chore`: Maintenance tasks (package updates, configuration)

