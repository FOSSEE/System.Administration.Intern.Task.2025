# FOSSEE System Administrator (Semester Long Internship Task 2025)

## Introduction

This project demonstrates implementation of Single Sign-On (SSO) across three applications: Drupal 11, Django, and PHP using Keycloak.

It is deployed on a Rocky Linux 10 DigitalOcean droplet with SSL-secured applications, reverse proxies via Apache, and secure database connections.

## Droplet IPs

- DigitalOcean Droplet **ipv4**: `139.59.37.53`
- DigitalOcean Droplet **ipv6**: `2400:6180:100:d0::b948:9001`

## Live Domains

- **Keycloak**: [https://abhaypratap.dev](https://abhaypratap.dev)

- **Drupal 11**: [https://drupal.abhaypratap.dev](https://drupal.abhaypratap.dev)

- **Django**: [https://django.abhaypratap.dev](https://django.abhaypratap.dev)

- **PHP APP**: [https://php.abhaypratap.dev](https://php.abhaypratap.dev)

## Project Structure

```
.
├── docs/
│   ├── 01-server-setup.md
│   ├── 02-keycloak.md
│   ├── 03-drupal.md
│   ├── 04-django.md
│   ├── 05-php.md
│   ├── 05-php_app/
│   │   └── ...
│   ├── 06-testing.md
│   └── screenshots/
│       ├── django/
│       │   └── [...]
│       ├── drupal/
│       │   └── [...]
│       ├── keycloak/
│       │   └── [...]
│       ├── php/
│       │   └── [...]
│       ├── server/
│       │   └── [...]
│       └── testing/
│           └── [...]
└── README.md
```

## How to Follow Documentation

1. Start with [01-server-setup.md](/docs/01-server-setup.md) to configure the droplet, firewall, and Apache.

2. Proceed to [02-keycloak.md](/docs/02-keycloak.md) to install and configure Keycloak.

3. Follow [03-drupal.md](/docs/03-drupal.md) for Drupal app deployment and SSO integration.

4. Follow [04-django.md](/docs/04-django.md) for Django app deployment and SSO integration.

5. Follow [05-php.md](/docs/05-php.md) for PHP app deployment and SSO integration.

6. Follow [06-testing.md](/docs/06-testing.md) to test the functionality of the entire project.

> **Note:** All users must have an **email address** set in Keycloak to log in to Django, Drupal, and PHP applications.

## Features Implemented

- Secure server environment: **Firewall**, **SSL** certificates, **Apache** configuration.

- **SSO across all applications**: Login once, access Drupal, Django, and PHP apps without re-authentication.

- **Single Logout (SLO)**: Logging out from any app terminates all sessions.

- **PHP OIDC** client integration: Stores tokens, session management, profile display.

- Database integration: **MariaDB** for **Keycloak**, **Drupal** and **Django**.

## Author

**ABHAY PRATAP**

Contact: [abhay.pratap.2005p@gmail.com](mailto:abhay.pratap.2005p@gmail.com)
