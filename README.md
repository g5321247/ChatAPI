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
| account      | String | Required    |
| password     | String | Required    |


- **Request Body Example**
```
{
  "account":"test@test.com",
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
    "error": "密碼不正確"
}
```
## Main Page
- **End Point:** `/user/mainPage`
- **Method:** `GET`
- **Request Example:**

 `http://[HOST_NAME]/api/[API_VERSION]/user/mainPage.php`
- **Query Parameters:**

| Field  | Type   | Description |
| ------ | ------ | ----------- |
| userID | String | Required    |

- **Request Example**
 `http://[HOST_NAME]/api/[API_VERSION]/user/mainPage.php?userID=20`

- **Success Response: 200**

| Field       | Type   | Description |
| ----------- | ------ | ----------- |
| user        | `User Object` | User information    |
| chat_groups | Array | Array of `Group Object`    |
| friends     | Array | Array of `User Object`      |

- **User Object**

| Field       | Type   | Description                 |
| ----------- | ------ | -----------                 |
| id          | Int    | User's id                   |
| name        | String | User's name                 |
| picture     | String | User's profile picture      |
| status_text | String | User's status               |

- **Group Object**
  
| Field       | Type   | Description                 |
| ----------- | ------ | -----------                 |
| id          | Int    | Group's id                  |
| name        | String | Group's name                |
| picture     | String | Group's profile picture     |
| status_text | String | Group's status              |

- **Success Response Example**
```
Ex:
{
  "user": {
    "id": 1239890,
    "name": "Michael",
    "picture": "https://lorempixel.com/640/480/?94588",
    "status_text": "勇猛精進"
  },
  "chat_groups": {
    [
        "id": 1239890,
        "name": "跑跑跳",
        "picture": "https://lorempixel.com/640/480/?94588",
        "status_text": "勇猛精進"
    ]
  },
    "friends": {
    [
        "id": 1239890,
        "name": "Kai",
        "picture": "https://lorempixel.com/640/480/?94588",
        "status_text": "我好窮"
    ]
  }
}
```

- **Error Response: 403**

| Field        | Type   | Description  |
| ------------ | ------ | ------------ |
| error        | String | ErrorMessage |

- **Error Response Example**
```
{
    "error": "invalid user id"
}
```
