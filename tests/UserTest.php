<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    private $structer = [
        'fullname',
        'phone',
        'created_at',
        'updated_at'
    ];

    /**
     * Test get home page.
     * / [GET]
     * @return void
     */
    public function testHomepage()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(),
            $this->response->getContent()
        );
    }

    /**
     * Test get all users
     * /api/users [GET]
     * @return void
     */
    public function testShouldReturnAllUsers()
    {
        $this->get('/api/users')
            ->seeStatusCode(200)
            ->seeJsonStructure(['*' => $this->structer]);
    }

    /**
     * Test get a user.
     * /api/users/id [GET]
     * @return void
     */
    public function testShouldReturnUser()
    {
        $userId = 1;
        $this->get("/api/users/" . $userId)
            ->seeStatusCode(200)
            ->seeJsonContains(['id' => $userId])
            ->seeJsonStructure(['*' => $this->structer]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserFailCaseFullnameOverMaxlength()
    {
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh Nguyen Thi Hanh Nguyen Nguyen Thi Hanh',
            'phone' => '0977222111',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['fullname' => ['The fullname may not be greater than 50 characters.']]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserFailCaseFullnameEmpty()
    {
        $parameters = [
            'fullname' => '',
            'phone' => '0977222111',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['fullname' => ['The fullname field is required.']]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserFailCasePhoneEmpty()
    {
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh',
            'phone' => '',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone field is required.']]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserFailCasePhoneOverMaxlength()
    {
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh',
            'phone' => '0977222111097722211109772221110977222111',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone must be between 1 and 20 digits.']]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserFailCasePhoneUnique()
    {
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh',
            'phone' => '0977888999',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone has already been taken.']]);
    }

    /**
     * Test create a users.
     * /api/users [POST]
     * @return void
     */
    public function testShouldCreateUserSuccess()
    {
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh',
            'phone' => '0977222111',
        ];
        $this->post("/api/users", $parameters)
            ->seeStatusCode(201)
            ->seeJsonContains($parameters)
            ->seeJsonStructure(['*' => $this->structer]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCaseUserIdNotFound()
    {
        $userId = 10000000000;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '0977444333',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(404);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCaseFullnameEmpty()
    {
        $userId = 1;
        $parameters = [
            'fullname' => '',
            'phone' => '0977444333',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['fullname' => ['The fullname field is required.']]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCaseFullnameOverMaxlength()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Nguyen Thi Hanh Nguyen Thi Hanh Nguyen Nguyen Thi Hanh',
            'phone' => '0977444333',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['fullname' => ['The fullname may not be greater than 50 characters.']]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCasePhoneEmpty()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone field is required.']]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCasePhoneOverMaxlength()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '0977222111097722211109772221110977222111',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone must be between 1 and 20 digits.']]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserFailCasePhoneExistOtherUser()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '0977555666',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(422)
            ->seeJsonContains(['phone' => ['The phone has already been taken.']]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserSuccessCasePhoneIsUser()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '0977888999',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(200)
            ->seeJsonContains(array_merge(['id' => $userId], $parameters))
            ->seeJsonStructure(['*' => $this->structer]);
    }

    /**
     * Test update user.
     * /api/users/id [PUT]
     * @return void
     */
    public function testShouldUpdateUserSuccess()
    {
        $userId = 1;
        $parameters = [
            'fullname' => 'Tran Van Phat',
            'phone' => '0977444333',
        ];
        $this->put("/api/users/" . $userId, $parameters)
            ->seeStatusCode(200)
            ->seeJsonContains(array_merge(['id' => $userId], $parameters))
            ->seeJsonStructure(['*' => $this->structer]);
    }

    /**
     * Test delete user.
     * /api/users/id [DELETE]
     * @return void
     */
    public function testShouldDeleteUserFailCaseUserIdNotFound()
    {
        $userId = 100000000;
        $this->delete("/api/users/" . $userId)
            ->seeStatusCode(404);
    }

    /**
     * Test delete user.
     * /api/users/id [DELETE]
     * @return void
     */
    public function testShouldDeleteUserSucess()
    {
        $userId = 1;
        $this->delete("/api/users/" . $userId)
            ->seeStatusCode(200)
            ->notSeeInDatabase('users', ['id' => $userId]);
    }
}
