<?php

namespace SekoiaLearn\CrocodocBundle\Service;

class CrocodocService
{
    /**
     * Initialize a new Crocodoc service.
     *
     * @param $apiKey
     *          The Crocodoc API key.
     */
    function __construct($apiKey)
    {
        \Crocodoc::setApiToken($apiKey);
    }

    /**
     * Create a Crocodoc session.
     *
     * @param $crocodocDocumentId string
     *          The Crocodoc ID of the document for a which a session is to be created.
     * @param $options array
     *          Associative array with options for the session. This array can contain an "isEditable" boolean,
     *          a "user" associative array with "id" and "name" fields, a "filter" string, a "sidebar" string, and
     *          booleans for "isAdmin", "isDownloadable", "isCopyprotected", and "isDemo".
     * @return string
     *          The created session ID.
     * @throws \LogicException
     *          Crocodoc exception caught while processing the request.
     */
    public function createSession($crocodocDocumentId, $options)
    {
        try {
            $sessionId = \CrocodocSession::create($crocodocDocumentId, $options);
        }
        catch (\CrocodocException $e) {
            throw new \LogicException($e->getMessage());
        }

        return $sessionId;
    }

    /**
     * Upload a document to Crocodoc.
     *
     * @param $filePath string
     *          The path of the file to upload.
     * @return string
     *          The Crocodoc ID of the uploaded document.
     */
    public function uploadDocument($filePath)
    {
        $fileHandle = fopen($filePath, 'r');
        $uuid = \CrocodocDocument::upload($fileHandle);
        fclose($fileHandle);

        return $uuid;
    }

    /**
     * @param $crocodocDocIds string|array
     *          A Crocodoc document ID or an array of Crocodoc document IDs.
     * @return array
     *          An associative array containing the status of the queried document(s).
     *          The keys for the returned status of a document are 'status' (string) and 'viewable' (boolean).
     *          If an array of document IDs is given as the parameter, the returned array is an associative array
     *          containing status arrays for each document ID with the document ID as the key of each corresponding
     *          document.
     * @throws \InvalidArgumentException
     *          The given parameter is not a string or an array.
     */
    public function getStatus($crocodocDocIds)
    {
        if (! (is_string($crocodocDocIds) || is_array($crocodocDocIds))) {
            throw new \InvalidArgumentException('Invalid parameter value');
        }

        return \CrocodocDocument::status($crocodocDocIds);;
    }
}