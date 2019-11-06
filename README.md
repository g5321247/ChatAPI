# Chat-API-Doc
## HOST_URL
xxxxxx

## API Version
1.0


## User Sign In API
End Point: /user/signin

Method: POST

Request Headers:

Field	Type	Description
Content-Type	String	Only accept application/json.

Request Body
Field	Type	Description
email	String	Required if provider set to native
password	String	Required if provider set to native

```
Request Body Example:
{
  "provider":"native",
  "email":"test@test.com",
  "password":"test"
}
```

帳號：a123456@hotmail.com
密碼: 12345678
