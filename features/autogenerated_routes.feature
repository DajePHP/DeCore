Feature: generated routes
  In order to fast rapid application
  As a developer
  I need to be have a convention to create route on the controllers.

  Scenario: Get action
    Given a controller file like "fixtures/SimpleRootBlogController.php":
    When I request an url like /blogs/123 with "GET" method
    Then the response content should be:
    """
{"hello developer"}
    """

  Scenario: Post action
    Given a controller file like "fixtures/SimpleRootBlogController.php":
    When I request an url like /blogs/123 with "POST" method
    Then the response status code should be "201"