# Chat-API-Doc
### Host Name

george.darklit.tw

### API Version

1.0

## API List
[Signup](#User Signup)  

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

## Chat List
- **End Point:** `/chat/chatList`
- **Method:** `GET`
- **Request Example:**

 `http://[HOST_NAME]/api/[API_VERSION]/chat/chatList.php`
- **Query Parameters:**

| Field  | Type   | Description |
| ------ | ------ | ----------- |
| userID | Int    | Required    |

- **Request Example**
 `http://[HOST_NAME]/api/[API_VERSION]/chat/chatList.php?userID=20`

- **Success Response: 200**

| Field       | Type   | Description |
| ----------- | ------ | ----------- |
| data | Array | Array of `Chat Object`    |

- **Chat Object**
  
| Field             | Type   | Description                                |
| -----------       | ------ | -----------                                |
| chat_id           | Int    | Chat's id                                  |
| name              | String | Chat's title                               | 
| picture           | String | Chat's picture                             |
| last_message      | String | last message in chatroom                   |
| last_message_time | Number | Lastest sending message time in unix time. |

- **Success Response Example**
```
Ex:
{
    "data": [
        {
            "chat_id": 5,
            "name": "JoJo",
            "picture": "",
            "last_message": "兒三個式即？發前一兒。醫看腦下在小運，你目決以股屋人落了作道可；親去多票養該在。",
            "last_message_time": 1576385584
        },
        {
            "chat_id": 3,
            "name": "大台北租屋",
            "picture": "https://www.hcland.com.tw//upload/20180610114703ugwsu1.jpg",
            "last_message": "又叫題，不物精記告，了林的的玩故用不然生進食識調速是便公現告古，他得畫，輪多水小縣去古；裡因廣上，子實益興其？你持草遊。可好足的到你不我為處間傷",
            "last_message_time": 1576345584
        }
    ]
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

## Main Page
- **End Point:** `/user/mainPage`
- **Method:** `GET`
- **Request Example:**

 `http://[HOST_NAME]/api/[API_VERSION]/user/mainPage.php`
- **Query Parameters:**

| Field  | Type   | Description |
| ------ | ------ | ----------- |
| userID | Int    | Required    |

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
  "chat_groups": [
    {
        "id": 1239890,
        "name": "跑跑跳",
        "picture": "https://lorempixel.com/640/480/?94588",
        "status_text": "勇猛精進"
    }
  ],
    "friends": [
    {
        "id": 1239890,
        "name": "Kai",
        "picture": "https://lorempixel.com/640/480/?94588",
        "status_text": "我好窮"
    }
  ]
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

## Chat Room
- **End Point:** `/chat/chatroom`
- **Method:** `GET`
- **Request Example:**

 `http://[HOST_NAME]/api/[API_VERSION]/chat/chatroom.php`
- **Query Parameters:**

| Field   | Type   | Description |
| ------  | ------ | ----------- |
| groupID | Int    | Required    |

- **Request Example**
 `http://[HOST_NAME]/api/[API_VERSION]/chat/chatList.php?userID=20`

- **Success Response: 200**

| Field       | Type   | Description |
| ----------- | ------ | ----------- |
| data | Array | Array of `Message Object`    |

- **Message Object**
  
| Field             | Type           | Description                                |
| -----------       | ------         | -----------                                |
| sender            | `User Object`  | Message sender info                        |
| content           | String         | last message in chatroom                   |
| sending_time      | Number         | Lastest sending message time in unix time. |

- **Success Response Example**
```
Ex:
{
    "data": [
        {
            "sender": {
                "id": 1239890,
                "name": "Michael",
                "picture": "https://lorempixel.com/640/480/?94588",
                "status_text": "勇猛精進"
            },
            "content": "66666",
            "sending_time": 1576345584
        },
        {
            "sender": {
                "id": 6626251,
                "name": "Peter",
                "picture": "https://lorempixel.com/640/480/?94588",
                "status_text": "我不爽"
            },
            "content": "你在說啥",
            "sending_time": 1576345573
        }
    ]
}
```

- **Error Response: 403**

| Field        | Type   | Description  |
| ------------ | ------ | ------------ |
| error        | String | ErrorMessage |

- **Error Response Example**
```
{
    "error": "對話不存在"
}
```
