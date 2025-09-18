# Step 6: Testing & Validation

This document verifies the SSO integration across all applications (Drupal, Django, PHP) with Keycloak.

## 1. Prerequisites

- Keycloak running at: `https://abhaypratap.dev`
- Django app: `https://django.abhaypratap.dev`
- PHP app: `https://php.abhaypratap.dev`
- Drupal app: `https://drupal.abhaypratap.dev`
- All Keycloak clients configured with:
  - Redirect URIs
  - Post-logout redirect URIs
  - Web Origins
  - Frontchannel and Backchannel logout enabled (For Single Logout)

## 2. Keycloak User Accounts

The following test accounts have been created in Keycloak for evaluation. Use these to log in to Drupal, Django, and PHP applications.

```
| Username  | Email          | Password |
|-----------|----------------|----------|
| test1     | test@test.com  | test1    |
| test2     | test2@test.com | test2    |
| testuser  | test@user.com  | test     |
```

> **Note:** All users must have an **email address** set in Keycloak to login in Django, Drupal, and PHP applications.

## 3. Login Flow

1. Open `https://drupal.abhaypratap.dev`

   - Click Login with Keycloak
   - Redirects to Keycloak
   - Enter Credentials (e.g., username: testuser, pass: test)
   - Redirect back to Drupal with logged-in session

2. Open `https://django.abhaypratap.dev`

   - Click Login
   - Redirects to Keycloak
   - Enter Credentials
   - Redirect back to Django, username shown

3. Open `https://php.abhaypratap.dev`
   - Click Login
   - Redirects to Keycloak
   - Enter Credentials
   - Redirect back to PHP home page

## 4. Single Sign-On (SSO) Flow

- Login once in **Keycloak** through any app
- Access all 3 apps without re-authentication.
- SSO session sharing confirmed.

## 5. Single Logout (SLO) Flow

- Logout from anyone of the app (e.g, Django) -> Redirects to Keycloak -> Session terminated.
- Other apps (Drupal, PHP, Django) automatically gets logged out.
- Verified that logging out from any one app logs out all apps. (SLO enabled)

## 6. Screenshots

![Drupal-Login](screenshots/testing/Drupal-Login.png)

![Django-Login](screenshots/testing/Django-Login.png)

![PHP-Login](screenshots/testing/PHP-Login.png)

![Keycloak](screenshots/testing/Keycloak.png)

![Drupal-Home](screenshots/testing/Drupal-Home.png)

![Django-Home](screenshots/testing/Django-Home.png)

![PHP-Home](screenshots/testing/PHP-Home.png)

## Conclusion:

Keycloak SSO works seamlessly across **Drupal, Django, and PHP**, with consistent login and logout.
