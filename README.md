Here is a structured API documentation for your Laravel project based on the information you provided. You can customize it further to fit your needs.

---

# API Documentation for Laravel Project

## Base URL
```
http://127.0.0.1:8080/api/v1
```

## Authentication
All endpoints require authentication. Use the following login endpoint to obtain an access token.

### Login
**Endpoint:** `POST /login`  
**Description:** Authenticates a user and returns an access token.

**Request Headers:**
- `Accept: application/json`
- `Content-Type: application/json`

**Request Body:**
```json
{
    "email": "user@example.com",
    "password": "your_password"
}
```

**Sample Requests:**
```bash
curl --location 'http://127.0.0.1:8080/api/v1/login' \
--header 'Accept: application/json' \
--header 'Content-Type: application/json' \
--data-raw '{
    "email":"peyman.courier@test.com",
    "password":"123456"
}'
```

**Sample Response:**
```json
{
    "token_type": "Bearer",
    "expires_in": 31536000,
    "access_token": "value",
    "refresh_token": "value"
}
```

## Company Orders

### Create Order
**Endpoint:** `POST /company/orders`  
**Description:** Creates a new order for a company.

**Request Headers:**
- `Authorization: Bearer {access_token}`

**Request Body:**
```json
{
    "company_id": 1,
    "provider_name": "shop company",
    "provider_mobile": "09213910615",
    "provider_address": "num6 25alley niaz street tehran",
    "provider_latitude": "32.8795521",
    "provider_longitude": "52.5487124",
    "receiver_name": "alex joseph",
    "receiver_mobile": "09359341940",
    "receiver_address": "num6 25alley niaz street tehran",
    "receiver_latitude": "31.5487965",
    "receiver_longitude": "51.5487124"
}
```

**Sample Response:**
```json
{
    "data": {
        "id": 1,
        "company_id": 1,
        "provider_name": "shop company",
        "provider_mobile": "09213910615",
        "provider_address": "num6 25alley niaz street tehran",
        "provider_latitude": "32.8795521",
        "provider_longitude": "52.5487124",
        "receiver_name": "alex joseph",
        "receiver_mobile": "09359341940",
        "receiver_address": "num6 25alley niaz street tehran",
        "receiver_latitude": "31.5487965",
        "receiver_longitude": "51.5487124",
        "status": "waiting_courier",
        "created_at": "2025-03-04T15:23:51.000000Z",
        "updated_at": "2025-03-04T15:23:51.000000Z"
    }
}
```

### Get Order by ID
**Endpoint:** `GET /company/orders/{id}`  
**Description:** Retrieves a specific order by ID.

**Request Parameters:**
- `company_id`: ID of the company (query parameter).

**Sample Request:**
```bash
curl --location 'http://127.0.0.1:8080/api/v1/company/orders/1?company_id=1'
```

### Get All Orders
**Endpoint:** `GET /company/orders`  
**Description:** Retrieves a list of all company orders.

**Sample Request:**
```bash
curl --location 'http://127.0.0.1:8080/api/v1/company/orders'
```

### Update Order Status
**Endpoint:** `PATCH /company/orders/{id}`  
**Description:** Updates the status of an existing order.

**Request Headers:**
- `Authorization: Bearer {access_token}`

**Request Body:**
```json
{
    "status": "canceled", // Options: waiting_courier, courier_en_route, courier_in_transit, done, canceled
    "company_id": 1
}
```

**Sample Response:**
```json
{
    "message": "Your request was successful"
}
```

## Courier Orders

### Create Courier Order
**Endpoint:** `POST /courier/orders`  
**Description:** Registers a new courier order.

**Request Headers:**
- `Authorization: Bearer {access_token}`

**Request Body:**
```json
{
    "order_id": 1
}
```

**Sample Response:**
```json
{
    "message": "Your request has been successfully registered"
}
```

### Get Pending Courier Orders
**Endpoint:** `GET /courier/orders/pending`  
**Description:** Retrieves a list of pending courier orders.

**Sample Response:**
```json
{
    "data": [
        {
            "id": 3,
            "provider_name": "shop company",
            "provider_mobile": "09213910615",
            "provider_address": "num6 25alley niaz street tehran",
            "provider_latitude": "32.8795521",
            "provider_longitude": "52.5487124",
            "receiver_name": "alex joseph",
            "receiver_mobile": "09359341940",
            "receiver_address": "num6 25alley niaz street tehran",
            "receiver_latitude": "31.5487965",
            "receiver_longitude": "51.5487124",
            "status": "waiting_courier",
            "created_at": "2025-03-04T15:30:25.000000Z",
            "updated_at": "2025-03-04T15:30:25.000000Z"
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8080/api/v1/courier/orders/pending?page=1",
        "last": "http://127.0.0.1:8080/api/v1/courier/orders/pending?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8080/api/v1/courier/orders/pending?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8080/api/v1/courier/orders/pending",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
```

### Get All Courier Orders
**Endpoint:** `GET /courier/orders`  
**Description:** Retrieves a list of all courier orders.

**Sample Response:**
```json
{
    "data": [
        {
            "id": 1,
            "user_id": 6,
            "order_id": 1,
            "status": "accepted",
            "accepted_at": "2025-03-04 15:28:23",
            "received_at": null,
            "delivered_at": null,
            "created_at": "2025-03-04T15:28:23.000000Z",
            "updated_at": "2025-03-04T15:28:23.000000Z",
            "order": {
                "id": 1,
                "company_id": 1,
                "provider_name": "shop company",
                "provider_mobile": "09213910615",
                "provider_address": "num6 25alley niaz street tehran",
                "provider_latitude": "32.8795521",
                "provider_longitude": "52.5487124",
                "receiver_name": "alex joseph",
                "receiver_mobile": "09359341940",
                "receiver_address": "num6 25alley niaz street tehran",
                "receiver_latitude": "31.5487965",
                "receiver_longitude": "51.5487124",
                "status": "courier_en_route",
                "created_at": "2025-03-04 15:23:51",
                "updated_at": "2025-03-04 15:28:23"
            }
        }
    ],
    "links": {
        "first": "http://127.0.0.1:8080/api/v1/courier/orders?page=1",
        "last": "http://127.0.0.1:8080/api/v1/courier/orders?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://127.0.0.1:8080/api/v1/courier/orders?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://127.0.0.1:8080/api/v1/courier/orders",
        "per_page": 15,
        "to": 1,
        "total": 1
    }
}
```

### Get Courier Order by ID
**Endpoint:** `GET /courier/orders/{id}`  
**Description:** Retrieves a specific courier order by ID.

**Sample Response:**
```json
{
    "data": {
        "id": 1,
        "user_id": 6,
        "order_id": 1,
        "status": "accepted",
        "accepted_at": "2025-03-04 15:28:23",
        "received_at": null,
        "delivered_at": null,
        "created_at": "2025-03-04T15:28:23.000000Z",
        "updated_at": "2025-03-04T15:28:23.000000Z",
        "order": {
            "id": 1,
            "company_id": 1,
            "provider_name": "shop company",
            "provider_mobile": "09213910615",
            "provider_address": "num6 25alley niaz street tehran",
            "provider_latitude": "32.8795521",
            "provider_longitude": "52.5487124",
            "receiver_name": "alex joseph",
            "receiver_mobile": "09359341940",
            "receiver_address": "num6 25alley niaz street tehran",
            "receiver_latitude": "31.5487965",
            "receiver_longitude": "51.5487124",
            "status": "courier_en_route",
            "created_at": "2025-03-04 15:23:51",
            "updated_at": "2025-03-04 15:28:23"
        }
    }
}
```

### Update Courier Order Status
**Endpoint:** `PATCH /courier/orders/{id}`  
**Description:** Updates the status of a courier order.

**Request Headers:**
- `Authorization: Bearer {access_token}`

**Request Body:**
```json
{
    "status": "emergency_canceled"  // Options: accepted, received, delivered, emergency_canceled
}
```

**Sample Response:**
```json
{
    "message": "Your request has been successfully updated"
}
```

---

### Additional Setup Instructions

1. Clone the project from the repository.
2. Create a `.env` file from `.env.example`.
3. Run the following command:
   ```bash
   docker-compose up -d --build
   ```
4. Enter the Docker container:
   ```bash
   docker exec -it rapidgo.app bash
   ```
5. Install Composer dependencies:
   ```bash
   composer install
   ```
6. Run database migrations and seeders:
   ```bash
   php artisan migrate --seed
   ```
7. Retrieve the client secret and client ID from the database and add them to your `.env` file.

Now your project is ready for use!

---

Feel free to modify any sections or add more details as necessary. Let me know if you need further assistance!
