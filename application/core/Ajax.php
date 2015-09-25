<?php

class Ajax
{
	
	public function __construct()
	{
		global $application;
		$this->application = $application;
	}
	
    public function addEntry()
    {
        return $this->application->addEntry();
    }
    
    public function editEntry()
    {
        return $this->application->editEntry();
    }
    
    public function editChild()
    {
        return $this->application->editChild();
    }
    
    public function getEntry()
    {
        return $this->application->getEntry();
    }
    
    public function getEntries()
    {
        return $this->application->getEntries();
    }
    
    public function removeEntry()
    {
        return $this->application->removeEntry();
    }
    
    public function getEntriesHtml()
    {
        return $this->application->getEntriesHtml();
    }
    
    public function getChildrenHtml()
    {
        return $this->application->getChildrenHtml();
    }
    
    public function signUp()
    {
        return $this->application->signUp();
    }
    
    public function signIn()
    {
        return $this->application->signIn();
    }
    
    public function signOut()
    {
        return $this->application->signOut();
    }
    
    public function uniqueEmail()
    {
        return $this->application->uniqueEmail();
    }
    
    public function addAChild()
    {
        return $this->application->addAChild();
    }
    
    public function editAChild()
    {
        return $this->application->editAChild();
    }
    
    public function removeChild()
    {
        return $this->application->removeChild();
    }
    
    public function getChild()
    {
        return $this->application->getChild();
    }
}