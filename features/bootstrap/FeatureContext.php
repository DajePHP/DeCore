<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given a :methodArgument request to the url :url with the headers like:
     */
    public function aRequestToTheUrlWithTheHeadersLike($methodArgument, $url, PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @When I execute $stack->handle()
     */
    public function iExecuteStackHandle()
    {
        throw new PendingException();
    }

    //--------------------------

    /**
     * @Given a controller file like :path:
     */
    public function aControllerFileLike($path)
    {
        throw new PendingException();
    }

    /**
     * @When I request an url like \/blogs\/:arg2 with :httpMethod method
     */
    public function iRequestAnUrlLikeBlogsWithMethod($arg1, $httpMethod)
    {
        throw new PendingException();
    }

    /**
     * @Then the response content should be:
     */
    public function theResponseContentShouldBe(PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Then the response status code should be :arg1
     */
    public function theResponseStatusCodeShouldBe($arg1)
    {
        throw new PendingException();
    }
}
