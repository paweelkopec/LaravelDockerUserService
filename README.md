# Environment:

`./vendor/bin/sail up -d`
`./vendor/bin/sail artisan migrate`

**Create admin user with token:**

`
docker-compose exec webapp php artisan tinker
`

paste following code:

`
$user = User::create(['name'=>'admin', 'email'=>'admin@admin.com', 'email_verified_at'=> now(), 'password'=> bcrypt('adminpass')]);
$token = $user->createToken('auth_token', ['user:update','user:list', 'user:delete'])->plainTextToken;
`

**Create user:**

``
curl --location --request POST 'http://0.0.0.0:8000/api/register' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data-raw '{"username": "Bin","full_name": "Game", "address": "DE", "email": "johan.aaaaoe@testa.com", "password": "testpassword"}'
``

**Response:**

`
{
    "access_token": "2|jQv269pYiR8ARLyIkHNKUOky1URYMjSzl77nr0SU",
    "token_type": "Bearer"
}
`

**Login:**

`curl --location --request POST 'http://0.0.0.0:8000/api/login' \
 --header 'Content-Type: application/json' \
 --header 'Accept: application/json' \
 --data-raw '{ "email": "johan.doe@test.com", "password": "testpassword"}'`
 
 **Response:**
 
 `{
      "access_token": "5|pI9w1nxAEgTAChh5SwGEBghflXjRgFZDxTqPiBsY",
      "token_type": "Bearer"
  }`
  
  **Logout**
  
  `curl --location --request DELETE 'http://0.0.0.0:8000/api/logout' \
   --header 'Authorization: Bearer 5|pI9w1nxAEgTAChh5SwGEBghflXjRgFZDxTqPiBsY' \
   --header 'Accept: application/json' \
   --data-raw ''`
   
   **Response:**
   
   `{"data":"User logged out."}`
   
   **User list:**
   
   `curl --location --request GET 'http://0.0.0.0:8000/api/users' \
    --header 'Authorization: Bearer 6|P1xeIDoxhgmVbYuPpsDxRj3dMJxfCnK7Mshgs7oQ' \
    --header 'Accept: application/json' \
    --data-raw ''`
    
    Response:
    `[
         {
             "id": 1,
             "username": "admin",
             "full_name": "admin",
             "address": "",
             "email": "admin@admin.com"
         },
         {
             "id": 2,
             "username": "john",
             "full_name": "John Doe",
             "address": "DE",
             "email": "johan.doe@test.com"
         }
     ]`
     
     **User detail**
     
    `curl --location --request GET 'http://0.0.0.0:8000/api/users/1' \
     --header 'Authorization: Bearer 6|P1xeIDoxhgmVbYuPpsDxRj3dMJxfCnK7Mshgs7oQ' \
     --header 'Accept: application/json' \
     --data-raw ''`
     
     **Response:**
     
     `{"id":1,"username":"admin","full_name":"admin","address":"","email":"admin@admin.com","email_verified_at":null,"created_at":"2022-09-22T11:02:05.000000Z","updated_at":"2022-09-22T11:02:05.000000Z"}`
     
     **User update**
     
     `curl --location --request PUT 'http://0.0.0.0:8000/api/users/2' \
      --header 'Authorization: Bearer 6|P1xeIDoxhgmVbYuPpsDxRj3dMJxfCnK7Mshgs7oQ' \
      --header 'Content-Type: application/json' \
      --header 'Accept: application/json' \
      --data-raw '{"full_name": "John Doe TEST", "address": "DE AZ", "email": "johan.doe@test2.com"}
      '`
      
      **Response:**
      
      `{
           "id": 2,
           "username": "john",
           "full_name": "John Doe TEST",
           "address": "DE AZ",
           "email": "johan.doe@test2.com",
       }`
   
   **User delete**
   
   `curl --location --request DELETE 'http://0.0.0.0:8000/api/users/2' \
    --header 'Authorization: Bearer 1|7NSIsaRgDFR2aJvU68KoOgjRKKEQ8QykHAAJSAy6' \
    --header 'Accept: application/json' \
    --data-raw ''`
    
    Response HTTP 204 No Content
   
