<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://cdn.iahorro.com/images/logo_ia-w.svg" width="400"></a></p>


# TECHNICAL TEST

## Functional requirements:

### Creating three endpoints

#### /api/v1/NewOpetarion

  It will be in charge of receiving, validating and persisting the new operations received by means of a POST call.

  The calls must contain the following parameters in the body:

    - name => Name of the user of the new operation.
    - surname1 => First surname of the user of the new operation.
    - surname2 => Second last name of the user of the new operation.
    - email => Email of the user of the new operation.  
    - phone => Phone of the user of the new operation.
    - provided_capital => Amount of capital to be provided by the user.
    - total_capital => Total amount of capital that the user will require.

  Example of valid payload

    {
    "name": "Fernando",
    "surname1": "Ariza",
    "surname2": "Serrano",
    "email": "example@gmail.com",
    "phone": "678949898",
    "provided_capital": 15000,
    "total_capital": 150000
    }

  
#### /api/v1/AssignUserToOperation

  The AssignUserToOperation endpoint executes the process that randomly assigns the managers to the new operations. 

  It does not receive any parameter, when called by patch method, it will execute the **AssignUserToOperation::assignUserToOperation** function.

  Once the execution is finished, the EndPoint will send a status code 200.


#### /api/v1/GetOperationsList/{user_id}/{dateFrom}/{dateTo}

  The GetOperationsList endpoint shows the managers a list of the operations assigned to them, provided that the date of creation of the operation is between the parameters dateFrom and dateTo.

  Must be invoked with the GET method and the parameters (all mandatory) must be sent via the URL.

  Once the parameters have been validated and the records have been retrieved from the database, the percentage of the user's capital will be calculated.

  When the information retrieval and calculations are finished, the information will be returned in JSON format.

  Example of valid URL

    http://127.0.0.1:8000/api/v1/GetOperationsList/1/2018-09-19/2022-01-01

