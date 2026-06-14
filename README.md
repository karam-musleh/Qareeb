# Qareeb

<p align="center">
  <strong>Connecting Communities, Workspaces, Initiatives, and Services</strong>
</p>

<p align="center">
  <a href="https://qareeb.cc" target="_blank">Visit Website</a>
</p>

---

## Overview

Qareeb is a modern digital platform designed to connect individuals, organizations, coworking spaces, innovation hubs, local initiatives, and service providers through a unified ecosystem.

The platform enables users to discover opportunities, explore local hubs, access services, participate in initiatives, and manage bookings through a seamless digital experience.

Built with scalability and maintainability in mind, Qareeb provides a centralized solution for managing spaces, services, initiatives, reservations, and user engagement.

---

## Key Features

### Hub & Workspace Discovery

- Discover coworking spaces and innovation hubs
- Browse facilities, services, and locations
- Advanced search and filtering capabilities
- Detailed hub profiles

### Initiative Management

- Publish and manage community initiatives
- Promote programs and activities
- Track participation and engagement

### Service Marketplace

- Publish and manage services
- Service categorization and discovery
- Provider profile management

### Booking System

- Online booking and reservation management
- Availability scheduling
- Booking status tracking
- Automated notifications

### User Engagement

- Ratings and reviews
- User profiles
- Social authentication
- Community interaction features

### Notifications & Communication

- Email notifications
- In-platform notifications
- Automated communication workflows

### Multilingual Support

- Arabic
- English

---

## Technology Stack

### Backend

| Technology        | Description           |
| ----------------- | --------------------- |
| Laravel 12        | Application Framework |
| PHP 8.4+          | Backend Runtime       |
| JWT               | API Authentication    |
| Laravel Sanctum   | Token Management      |
| Swagger / OpenAPI | API Documentation     |
| MySQL / MariaDB   | Relational Database   |
| Eloquent ORM      | Database Layer        |
| AWS R2            | Cloud Storage         |

### Frontend

| Technology     | Description  |
| -------------- | ------------ |
| Vite           | Build Tool   |
| Tailwind CSS 4 | UI Framework |
| Axios          | HTTP Client  |

### Additional Services

| Service             | Purpose               |
| ------------------- | --------------------- |
| Laravel Socialite   | Social Authentication |
| Resend              | Transactional Emails  |
| Spatie Translatable | Multilingual Content  |
| PHPUnit             | Testing               |
| Laravel Pint        | Code Formatting       |

---

## System Requirements

### Required

- PHP 8.4+
- Composer
- Node.js 18+
- npm
- MySQL 8+ or MariaDB 10.5+
- Apache or Nginx

### Optional

- Docker
- Laravel Sail
- AWS Account for Cloud Storage

---

## Installation

### Clone Repository

```bash
git clone <repository-url>
cd qareeb
```

### Install Dependencies

```bash
composer install
npm install
```

### Configure Environment

```bash
cp .env.example .env
php artisan key:generate
php artisan jwt:secret
```

### Database Setup

```bash
php artisan migrate
php artisan db:seed
```

### Build Assets

```bash
npm run build
```

### Start Development Server

```bash
php artisan serve
npm run dev
```

Application URL:

```text
http://localhost:8000
```

---

## API Documentation

Interactive API documentation is available through Swagger/OpenAPI.

```text
/api/documentation
```

OpenAPI Specification:

```text
/public/openapi.json
```

---

## Project Structure

```text
app/
├── Actions
├── Console
├── Enum
├── Events
├── Http
│   ├── Controllers
│   ├── Requests
│   └── Resources
├── Mail
├── Models
├── Notifications
├── Policies
└── Traits

database/
├── migrations
├── factories
└── seeders

resources/
├── css
├── js
└── views

routes/
├── api.php
├── web.php
└── console.php

tests/
storage/
public/
config/
```

---

## API Features

- JWT Authentication
- Social Login Authentication
- Role-Based Access Control
- RESTful API Architecture
- OpenAPI Documentation
- Multi-language Support
- Cloud File Uploads
- Notification System

---

## Testing

Run all tests:

```bash
php artisan test
```

Run a specific test:

```bash
php artisan test --filter=TestName
```

---

## Highlights

- Scalable Laravel Architecture
- Modular Design
- API-First Development
- Cloud Storage Integration
- Multi-language Support
- Secure Authentication
- Automated Testing
- Production-Ready Structure

---

## Website

https://qareeb.cc

---

## Development Team

### Backend Development

**Karam Ayman Musleh**

Email: [karammusleh74@gmail.com](mailto:karammusleh74@gmail.com)

### Frontend Development

**Ayman AlFarra**

Email: [aymanelfarra2004@gmail.com](mailto:aymanelfarra2004@gmail.com)

---

## License

This project is licensed under the MIT License.
