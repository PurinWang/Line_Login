# Line Login
[Packagist Link](https://packagist.org/packages/purinwang/line_login#0.0.0)

```
composer require purinwang/line_login
```
## Require
- php >= 5.6
- line login 2.1
## Flow
1. Set `ConfigManager`, default use .env to setting
    > Could rename .env.example to .env
2. Use `LineAuthorization` to get **Line Login** url, then redriect to **Line Login** page
3. After click login, it will callback to `line_redirect_uri` and use `Get Method` return `code` parameter
    > The .env `line_redirect_uri` will control Callback url
4. Get User info (Two Way)
    
    4.1 New `OAuthController`, and use `getAccessToken` with `code` to get user info
    > include `access_token`, expires_in, `id_token`, `refresh_token`, scope, token_type

    Then new `LineProfileController`, and use `getUserprofile` with `access_token` to get user detail
    > include `userId`, `displayName`, `pictureUrl`, `statusMessage`

    4.2 New `OAuthController` and use `getDecodeIdData` with `code` to get user info with `email`
    > include `iss`(url), `sub`(UserId), `name`, `picture`, `email`...
    >>If you need to get `email` field, you need to apply permission at [LINE Develope](https://developers.line.biz/zh-hant/docs/line-login/integrate-line-login/#applying-for-email-permission) and use `getDecodeIdData`

## Notice
1. some method cloud use detail parameter to get real callback info or it will get a part of function assign data
    ```
    public function getDecodeIdData($code, $detail=false){
        ...
    ```
2. About getDecodeIdData, get `getAccessToken` the `TokenId` is [JWT](JWT.io) format.

   After explode by `.`, it will get three part and encode by base64
   - header 
   - payload -> real data
   - signature 

3. Example branch is a simple login example