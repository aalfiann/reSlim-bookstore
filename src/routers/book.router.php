<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

    // POST api to create Author
    $app->post('/book/author/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->addAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Author
    $app->post('/book/author/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->authorid = $datapost['AuthorID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->updateAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Author
    $app->post('/book/author/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->authorid = $datapost['AuthorID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deleteAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Author
    $app->get('/book/author/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showAuthor());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Author pagination
    $app->get('/book/author/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchAuthorAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Language
    $app->post('/book/language/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->addLanguage());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Language
    $app->post('/book/language/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->languageid = $datapost['LanguageID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->updateLanguage());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Language
    $app->post('/book/language/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->languageid = $datapost['LanguageID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deleteLanguage());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Language
    $app->get('/book/language/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showLanguage());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Language pagination
    $app->get('/book/language/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchLanguageAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Type
    $app->post('/book/type/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->addType());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Type
    $app->post('/book/type/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->typeid = $datapost['TypeID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->updateType());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Type
    $app->post('/book/type/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->typeid = $datapost['TypeID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deleteType());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Type
    $app->get('/book/type/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showType());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Type pagination
    $app->get('/book/type/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var($_GET['query'],FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchTypeAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Publisher
    $app->post('/book/publisher/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->addPublisher());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Publisher
    $app->post('/book/publisher/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->publisherid = $datapost['PublisherID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->updatePublisher());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Publisher
    $app->post('/book/publisher/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->publisherid = $datapost['PublisherID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deletePublisher());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Publisher
    $app->get('/book/publisher/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showPublisher());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Publisher pagination
    $app->get('/book/publisher/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var($_GET['query'],FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchPublisherAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Translator
    $app->post('/book/translator/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $book->website = $datapost['Website'];
        $body = $response->getBody();
        $body->write($book->addTranslator());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Translator
    $app->post('/book/translator/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->translatorid = $datapost['TranslatorID'];
        $book->detail = $datapost['Name'];
        $book->token = $datapost['Token'];
        $book->website = $datapost['Website'];
        $body = $response->getBody();
        $body->write($book->updateTranslator());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Translator
    $app->post('/book/translator/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->translatorid = $datapost['TranslatorID'];
        $book->token = $datapost['Token'];
        $body = $response->getBody();
        $body->write($book->deleteTranslator());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Translator
    $app->get('/book/translator/data/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showTranslator());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Translator pagination
    $app->get('/book/translator/data/search/{token}/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchTranslatorAsPagination());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Submit Book
    $app->post('/book/submitbook/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->samplelink = $datapost['SampleLink'];
        $book->fulllink = $datapost['FullLink'];
        $book->imagelink = $datapost['ImageLink'];
        $book->title = $datapost['Title'];
        $book->description = $datapost['Description'];
        $book->author = $datapost['Author'];
        $book->language = $datapost['Language'];
        $book->translator = $datapost['Translator'];
        $book->publisher = $datapost['Publisher'];
        $book->isbn = $datapost['ISBN'];
        $book->tags = $datapost['Tags'];
        $book->pages = $datapost['Pages'];
        $book->purpose = $datapost['Purpose'];
        $body = $response->getBody();
        $body->write($book->addSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Submit Book
    $app->post('/book/submitbook/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->samplelink = $datapost['SampleLink'];
        $book->fulllink = $datapost['FullLink'];
        $book->imagelink = $datapost['ImageLink'];
        $book->title = $datapost['Title'];
        $book->description = $datapost['Description'];
        $book->author = $datapost['Author'];
        $book->language = $datapost['Language'];
        $book->translator = $datapost['Translator'];
        $book->publisher = $datapost['Publisher'];
        $book->isbn = $datapost['ISBN'];
        $book->tags = $datapost['Tags'];
        $book->pages = $datapost['Pages'];
        $book->purpose = $datapost['Purpose'];
        $book->statusid = $datapost['StatusID'];
        $book->submitbookid = $datapost['SubmitBookID'];
        $book->bookid = $datapost['BookID'];
        $body = $response->getBody();
        $body->write($book->updateSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Submit Book
    $app->post('/book/submitbook/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->submitbookid = $datapost['SubmitBookID'];
        $body = $response->getBody();
        $body->write($book->deleteSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data pending SubmitBook
    $app->get('/book/submitbook/data/pending/{username}/{token}/{page}/{itemsperpage}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->showPendingSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data approved SubmitBook
    $app->get('/book/submitbook/data/approved/{username}/{token}/{page}/{itemsperpage}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->showApprovedSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data SubmitBook
    $app->get('/book/submitbook/data/all/{username}/search/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchAllSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to create Release Book
    $app->post('/book/release/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->samplelink = $datapost['SampleLink'];
        $book->fulllink = $datapost['FullLink'];
        $book->imagelink = $datapost['ImageLink'];
        $book->title = $datapost['Title'];
        $book->description = $datapost['Description'];
        $book->authorid = $datapost['AuthorID'];
        $book->languageid = $datapost['LanguageID'];
        $book->translatorid = $datapost['TranslatorID'];
        $book->publisherid = $datapost['PublisherID'];
        $book->isbn = $datapost['ISBN'];
        $book->typeid = $datapost['TypeID'];
        $book->tags = $datapost['Tags'];
        $book->pages = $datapost['Pages'];
        $book->price = $datapost['Price'];
        $body = $response->getBody();
        $body->write($book->addReleaseBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Release Book
    $app->post('/book/release/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->samplelink = $datapost['SampleLink'];
        $book->fulllink = $datapost['FullLink'];
        $book->imagelink = $datapost['ImageLink'];
        $book->title = $datapost['Title'];
        $book->description = $datapost['Description'];
        $book->authorid = $datapost['AuthorID'];
        $book->languageid = $datapost['LanguageID'];
        $book->translatorid = $datapost['TranslatorID'];
        $book->publisherid = $datapost['PublisherID'];
        $book->isbn = $datapost['ISBN'];
        $book->typeid = $datapost['TypeID'];
        $book->tags = $datapost['Tags'];
        $book->pages = $datapost['Pages'];
        $book->price = $datapost['Price'];
        $book->statusid = $datapost['StatusID'];
        $book->bookid = $datapost['BookID'];
        $body = $response->getBody();
        $body->write($book->updateReleaseBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Release Book
    $app->post('/book/release/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->bookid = $datapost['BookID'];
        $body = $response->getBody();
        $body->write($book->deleteReleaseBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show single data release book
    $app->get('/book/release/data/read/{bookid}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->bookid = $request->getAttribute('bookid');
        $body = $response->getBody();
        $body->write($book->showSingleReleaseBook());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // GET api to show all data publish Release Book
    $app->get('/book/release/data/publish/search/{page}/{itemsperpage}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->showPublishReleaseBook());
        return classes\Cors::modify($response,$body,200);
    })->add(new \classes\middleware\ApiKey(filter_var((empty($_GET['apikey'])?'':$_GET['apikey']),FILTER_SANITIZE_STRING)));

    // GET api to search all data publish Release Book for member (showroom)
    $app->get('/book/release/data/showroom/{username}/search/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->username = $request->getAttribute('username');
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchPublishReleaseBookShowroom());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to search all data Release Book
    $app->get('/book/release/data/all/search/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $book->token = $request->getAttribute('token');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $body = $response->getBody();
        $body->write($book->searchAllReleaseBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to add Book Library
    $app->post('/book/library/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->bookid = $datapost['BookID'];
        $book->price = $datapost['Price'];
        $body = $response->getBody();
        $body->write($book->addLibraryBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Book Library
    $app->post('/book/library/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->adminname = $datapost['Adminname'];
        $book->username = $datapost['Username'];
        $book->bookid = $datapost['BookID'];
        $book->statusid = $datapost['Status'];
        $body = $response->getBody();
        $body->write($book->updateLibraryBook());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Book Library
    $app->post('/book/library/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->bookid = $datapost['BookID'];
        $book->username = $datapost['Username'];
        $body = $response->getBody();
        $body->write($book->deleteLibraryBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to search data book library with pagination (superuser and admin only)
    $app->get('/book/library/data/pending/search/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $book->token = $request->getAttribute('token');
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $body->write($book->showPendingLibraryBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to search data book library with pagination (member only)
    $app->get('/book/library/data/{username}/search/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $book->token = $request->getAttribute('token');
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $body->write($book->showAllLibraryBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status payment
    $app->get('/book/payment/status/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showOptionPayment());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status release
    $app->get('/book/release/status/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showOptionRelease());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data status release
    $app->get('/book/submitbook/status/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $body = $response->getBody();
        $body->write($book->showOptionSubmitBook());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data report sales
    $app->get('/book/report/sales/{username}/all/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $book->token = $request->getAttribute('token');
        $book->firstdate = filter_var((empty($_GET['firstdate'])?'':$_GET['firstdate']),FILTER_SANITIZE_STRING);
        $book->lastdate = filter_var((empty($_GET['lastdate'])?'':$_GET['lastdate']),FILTER_SANITIZE_STRING);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $body->write($book->showAllReportSales());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to Save User Settings
    $app->post('/book/user/settings/save', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->fullname = $datapost['Fullname'];
        $book->account = $datapost['Account'];
        $book->bankname = $datapost['BankName'];
        $book->bankaddress = $datapost['BankAddress'];
        $body = $response->getBody();
        $body->write($book->saveUserSettings());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show user settings
    $app->get('/book/user/settings/read/{username}/{token}', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->token = $request->getAttribute('token');
        $book->username = $request->getAttribute('username');
        $body = $response->getBody();
        $body->write($book->showSingleUserSettings());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to add Withdrawal
    $app->post('/book/user/withdraw/new', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->username = $datapost['Username'];
        $book->adminname = $datapost['Adminname'];
        $book->fullname = $datapost['Fullname'];
        $book->account = $datapost['Account'];
        $book->bankname = $datapost['BankName'];
        $book->bankaddress = $datapost['BankAddress'];
        $book->noreference = $datapost['NoReference'];
        $book->amount = $datapost['Amount'];
        $book->evidence = $datapost['Evidence'];
        $book->fromname = $datapost['FromName'];
        $book->frombank = $datapost['FromBank'];
        $book->detail = $datapost['Detail'];
        $body = $response->getBody();
        $body->write($book->addWithdrawal());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to update Withdrawal
    $app->post('/book/user/withdraw/update', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->adminname = $datapost['Adminname'];
        $book->fullname = $datapost['Fullname'];
        $book->account = $datapost['Account'];
        $book->bankname = $datapost['BankName'];
        $book->bankaddress = $datapost['BankAddress'];
        $book->noreference = $datapost['NoReference'];
        $book->amount = $datapost['Amount'];
        $book->evidence = $datapost['Evidence'];
        $book->fromname = $datapost['FromName'];
        $book->frombank = $datapost['FromBank'];
        $book->detail = $datapost['Detail'];
        $book->withdrawid = $datapost['WithdrawID'];
        $body = $response->getBody();
        $body->write($book->updateWithdrawal());
        return classes\Cors::modify($response,$body,200);
    });

    // POST api to delete Withdrawal
    $app->post('/book/user/withdraw/delete', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $datapost = $request->getParsedBody();    
        $book->token = $datapost['Token'];
        $book->withdrawid = $datapost['WithdrawID'];
        $book->username = $datapost['Username'];
        $body = $response->getBody();
        $body->write($book->deleteWithdrawal());
        return classes\Cors::modify($response,$body,200);
    });

    // GET api to show all data Withdrawal
    $app->get('/book/user/withdrawal/{username}/all/{page}/{itemsperpage}/{token}/', function (Request $request, Response $response) {
        $book = new classes\bookstore\Book($this->db);
        $book->username = $request->getAttribute('username');
        $book->page = $request->getAttribute('page');
        $book->itemsPerPage = $request->getAttribute('itemsperpage');
        $book->token = $request->getAttribute('token');
        $book->firstdate = filter_var((empty($_GET['firstdate'])?'':$_GET['firstdate']),FILTER_SANITIZE_STRING);
        $book->lastdate = filter_var((empty($_GET['lastdate'])?'':$_GET['lastdate']),FILTER_SANITIZE_STRING);
        $book->search = filter_var((empty($_GET['query'])?'':$_GET['query']),FILTER_SANITIZE_STRING);
        $body = $response->getBody();
        $body->write($book->showAllWithdrawal());
        return classes\Cors::modify($response,$body,200);
    });