# Chat-API-Doc
### Host Name

george.darklit.tw

### API Version

1.0

## User Signup
- **End Point:** `/user/signup`
- **Method:** `POST`
- **Request Example:**

  `http://[HOST_NAME]/api/[API_VERSION]/user/signup.php`
- **Request Headers:**

| Field        | Type   | Description                  |
| ------------ | ------ | ---------------------------- |
| Content-Type | String | Only accept `application/json`|

- **Request Body**

| Field        | Type   | Description |
| ------------ | ------ | ----------- |
| email        | String | Required    |
| password     | String | Required    |


- **Request Body Example**
```
{
  "email":"test@test.com",
  "password":"test"
}
```

- **Success Response Example**
```
{
    "id": "1",
    "name": "Prof. Uriah Mraz",
    "picture": "https://picsum.photos/id/0/5616/3744",
    "status_text": "不放手直到夢想到手"
}
```

- **Error Response: 403**

| Field        | Type   | Description  |
| ------------ | ------ | ------------ |
| error        | String | ErrorMessage |

- **Error Response Example**
```
{
    "id": "1",
    "name": "Prof. Uriah Mraz",
    "picture": "https://picsum.photos/id/0/5616/3744",
    "status_text": "不放手直到夢想到手"
}
```
