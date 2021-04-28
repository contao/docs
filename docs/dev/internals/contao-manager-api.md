---
title: "Contao Manager API"
description: "How to control and access the Contao Manager through its REST API."
---


The Contao Manager is distributed as a Phar application. Apart from the graphical user interface,
the application also provides a REST API to interact with the webserver and Contao application.

The Contao Manager API is available under `/api` wherever you installed the Phar. 
If your website runs on `https://example.com`, and the Contao Manager has been uploaded as 
`contao-manager.phar.php` to the root folder, the API will be available at 
`https://example.com/contao-manager.phar.php/api/`.

To learn more about the available REST features, please consult our [OpenAPI documentation][API].


## Authentication

Authentication is necessary to interact with any API endpoint of the Contao Manager. 
There are two ways to authenticate, depending on your use case.


### Option 1: Temporary authentication using an HTTP-only cookie
    
This is the preferred approach if your UI is accessing the Contao Manager through the
browser, similar to what the Contao Manager does itself. Your UI will not need
to store any authentication details, as the browser securely takes care of that.
However, these access details also automatically expire, so they are only useful for
interactions where the user needs to log in to the Contao Manager prior to any API access.

Consult the [OpenAPI Docs][API] on how to use the `/api/session` endpoint.


### Option 2: Persistent authentication through API tokens

For long term authentication or without involving the browser, the Contao Manager
supports authentication tokens. Tokens are always bound to a specific user acccount
and work similar to any other OAuth authentication.

{{% notice info %}}
The Contao Manager does not actually implement standard OAuth, because it cannot. OAuth requires you to register an
application ID prior to accessing the OAuth endpoint. As an example: on Facebook, you have to register as a developer
and register your application to get a private key, before you can access the API and get a token. Because the Contao Manager
is distributed to every user, we cannot have a (predefined) list of applications that would be allowed to use OAuth.
{{% /notice %}}


#### Creating the API token

Creating a token is only possible after authenticating to the Contao Manager. Technically,
this means a user has to authentication through the `/api/session` endpoint in a browser,
to then be able to create an access token. Because users should not enter their username
and password on your website (where you could grab the password), the Contao Manager provides
a built-in workflow to get an API token.

Given the URL examples above, all you have to do is point the browser to the following location:

```
https://example.com/contao-manager.phar.php/#oauth?scope=admin&client_id=XXX&return_url=https://your-website.com/your-script.php
``` 

The supported & required parameters are:

- `scope` is the requested access. Currently only `admin` is a supported value, as the Contao Manager does not yet
  support permissions.
  
- `client_id` is a representative name for your application, which will be presented to the user.
  The `client_id` is also stored alongside the token, each `client_id` will get a different access
  token, but the same `client_id` will get the same token again on a subsequent request. 
 
- `return_url` is where the user is sent back to after allowing or denying access to your application. 
 
 
The user will be presented with the following dialog with two options:

![Contao Manager OAuth Screen](../images/oauth.png?width=449&classes=shadow)

1. When clicking on **Allow Access**, the Contao Manager will generate a token, append a `token=`
   query parameter to the `return_url` argument, and redirect the user to that URL. 
   You can then read the token from the query parameters and store it on your application.
   
2. If the user clicks on **Deny Access**, they will be redirected to the `return_url`, but **without** a `token=` parameter. 


#### Authenticating with an API token

Now that you sucessfully aquired a token, you can use it to perform API requests on the Contao Manager.
For each request, the token must be sent in an HTTP header.

1. Using tokens for authentication has been standardized as [RFC 6750][rfc6750] and is commonly known as _Bearer Authentication_,
   which is fully supported by the Contao Manager. Add the `Authentication: Bearer <your-token>` to your request header to authentication API requests.

2. Unfortunately, there are known issues with some versions of the Apache webservers, which will remove `Authentication: Bearer` headers
   from your request, so they will never reach the Contao Manager. To circumvent this issue, the Contao Manager supports an alternative
   `Contao-Manager-Auth: <your-token>` header for authentication.
   
If you are in control of the webserver where Contao Manager is running, and you can make sure you don't run into the mentioned issue, using
the standardized `Authentication` header is the preferred way. If you need to support any Contao Manager on any unknown host, the best
approach is to use the `Contao-Manager-Auth` header which will be ignored by Apache.


[API]: https://contao.github.io/contao-manager/api/index.html
[rfc6750]: https://tools.ietf.org/html/rfc6750
