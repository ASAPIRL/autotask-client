<?php

namespace Anteris\Autotask\API\ContactWebhookUdfFields;

use Anteris\Autotask\HttpClient;

/**
 * Handles all interaction with Autotask ContactWebhookUdfFields.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/ContactWebhookUdfFieldsEntity.htm Autotask documentation.
 */
class ContactWebhookUdfFieldService
{
    /** @var Client An HTTP client for making requests to the Autotask API. */
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new contactwebhookudffield.
     *
     * @param  ContactWebhookUdfFieldEntity  $resource  The contactwebhookudffield entity to be written.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function create(ContactWebhookUdfFieldEntity $resource)
    {
        $this->client->post("ContactWebhookUdfFields", $resource->toArray());
    }

    /**
     * Deletes an entity by its ID.
     *
     * @param  int  $id  ID of the ContactWebhookUdfField to be deleted.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function deleteById(int $id): void
    {
        $this->client->delete("ContactWebhookUdfFields/$id");
    }

    /**
     * Finds the ContactWebhookUdfField based on its ID.
     *
     * @param  string $id  ID of the entity to be retrieved.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function findById(int $id): ContactWebhookUdfFieldEntity
    {
        return ContactWebhookUdfFieldEntity::fromResponse(
            $this->client->get("ContactWebhookUdfFields/$id")
        );
    }

    /**
     * Returns an instance of the query builder for this entity.
     *
     * @see ContactWebhookUdfFieldQueryBuilder The query builder class.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function query(): ContactWebhookUdfFieldQueryBuilder
    {
        return new ContactWebhookUdfFieldQueryBuilder($this->client);
    }

    /**
     * Updates the contactwebhookudffield.
     *
     * @param  ContactWebhookUdfFieldEntity  $resource  The contactwebhookudffield entity to be updated.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function update(ContactWebhookUdfFieldEntity $resource): void
    {
        $this->client->put("ContactWebhookUdfFields/$resource->id", $resource->toArray());
    }
}