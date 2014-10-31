Feature: full-stack
  In order to use the entire stack from the Request to the Response
  As a developer
  I need to be able to have a json as response requesting a resource json.

  Scenario: json hello in english
    Given a "GET" request to the url "/hello/developer" with the headers like:
    """
Accept	application/json, text/plain, */*
Accept-Encoding	gzip, deflate
Accept-Language	en-US,en;q=0.5
     """
    When I execute $stack->handle()
    Then the response content should be:
    """
{"hello developer"}
    """

  Scenario: json hello in italian
    Given a "GET" request to the url "/hello/developer" with the headers like:
    """
Accept	application/json, text/plain, */*
Accept-Encoding	gzip, deflate
Accept-Language	en-US,en;q=0.5
     """
    When I execute $stack->handle()
    Then the response content should be:
    """
{"ciao developer"}
    """