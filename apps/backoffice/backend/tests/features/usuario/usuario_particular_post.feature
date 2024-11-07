Feature: Create a new particular user
  In order to have users of this role in the platform
  As a user with admin permissions
  I want to create a new user

  Scenario: A valid non existing user
    Given I send a PUT request to "/usuario/particular/eca11c68-370e-4a6f-aab9-a718860df370" with body:
    """
    {
      "email": "user@email.com",
      "password": "54321",
      "nombre": "particularname"
    }
    """
    Then the response status code should be 201
    And the response should be empty

  Scenario: With one event

    Given I send an event to the event bus:
      """
      {
        "data": {
          "id": "eca11c68-370e-4a6f-aab9-a718860df370",
          "type": "usuario.particular.created",
          "occurred_on": "2019-08-08T08:37:32+00:00",
          "attributes": {
            "id": "8c900b20-e04a-4777-9183-32faab6d2fb5",
            "nombre": "particularname",
            "email": "user@email.com"
          },
          "meta" : {
            "host": "111.26.06.93"
          }
        }
      }
      """
      And I send an event to the event bus:
      """
      {
        "data": {
          "id": "eca11c68-370e-4a6f-aab9-a718860df370",
          "type": "usuario.particular.created",
          "occurred_on": "2019-08-08T08:37:32+00:00",
          "attributes": {
            "id": "8c900b20-e04a-4777-9183-32faab6d2fb5",
            "nombre": "particularname",
            "email": "user@email.com"
          },
          "meta" : {
            "host": "111.26.06.93"
          }
        }
      }
      """
      And I send an event to the event bus:
      """
      {
        "data": {
          "id": "eca11c68-370e-4a6f-aab9-a718860df370",
          "type": "usuario.particular.created",
          "occurred_on": "2019-08-08T08:37:32+00:00",
          "attributes": {
            "id": "8c900b20-e04a-4777-9183-32faab6d2fb5",
            "nombre": "particularname",
            "email": "user@email.com"
          },
          "meta" : {
            "host": "111.26.06.93"
          }
        }
      }
      """
      When I send a "GET" request to "/courses-counter"
      Then the response status code should be 200
      And the response content should be:
      """
      {
        "total": 2
      }
      """

