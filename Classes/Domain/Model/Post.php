<?php
declare(strict_types = 1);

/*
 * This file is part of the package t3g/blog.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

namespace PoptinLtd\PoptinSmartPopupsAndContactForms\Domain\Model;

use TYPO3\CMS\Core\Utility\GeneralUtility; 
use TYPO3\CMS\Extbase\Annotation as Extbase;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Mvc\Web\Routing\UriBuilder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Post extends AbstractEntity
{
    protected $POPTIN_USER_ID ;
    
    protected $POPTIN_CLIENT_ID ;
    
    protected $POPTIN_TOKEN ;
    
    protected $POPTIN_LOGIN_URL ;
    
    protected $POPTIN_ACCOUNT_EMAIL ;
    
    protected $POPTIN_REGISTRATION_DATE ;
    
    protected $account_id ;
    
    public function __construct()
    {
        $this->initializeObject();
    }

    /**
     * initializeObject
     */
    public function initializeObject(): void
    {
        /* $this->categories = new ObjectStorage();
        $this->comments = new ObjectStorage();
        $this->tags = new ObjectStorage();
        $this->authors = new ObjectStorage();
        $this->media = new ObjectStorage(); */
    }
    

    
}
