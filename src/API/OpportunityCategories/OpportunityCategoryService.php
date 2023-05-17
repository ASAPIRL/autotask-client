<?php

namespace Anteris\Autotask\API\OpportunityCategories;

use Anteris\Autotask\HttpClient;
use Anteris\Autotask\Support\EntityFields\EntityFieldCollection;
use Anteris\Autotask\Support\EntityInformation\EntityInformationEntity;
use GuzzleHttp\Psr7\Response;

/**
 * Handles all interaction with Autotask OpportunityCategories.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/OpportunityCategoriesEntity.htm Autotask documentation.
 */
class OpportunityCategoryService
{
    /** @var Client An HTTP client for making requests to the Autotask API. */
    protected HttpClient $client;

    /** @var bool Use POST for /query requests. */
    protected bool $usePostForQuery;

    /**
     * Instantiates the class.
     *
     * @param  HttpClient  $client  The http client that will be used to interact with the API.
     * @param  bool    $usePostForQuery     Use POST for /query requests.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function __construct(HttpClient $client, bool $usePostForQuery = false)
    {
        $this->client = $client;
        $this->usePostForQuery = $usePostForQuery;
    }

    /**
     * Finds the OpportunityCategory based on its ID.
     *
     * @param  string $id  ID of the entity to be retrieved.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function findById(int $id): OpportunityCategoryEntity
    {
        return OpportunityCategoryEntity::fromResponse(
            $this->client->get("OpportunityCategories/$id")
        );
    }

    /**
     * Returns information about what fields an entity has.
     *
     * @see EntityFieldCollection
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function getEntityFields(): EntityFieldCollection
    {
        return EntityFieldCollection::fromResponse(
            $this->client->get("OpportunityCategories/entityInformation/fields")
        );
    }

    /**
     * Returns information about what actions can be made against an entity.
     *
     * @see EntityInformationEntity
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function getEntityInformation(): EntityInformationEntity
    {
        return EntityInformationEntity::fromResponse(
            $this->client->get("OpportunityCategories/entityInformation")
        );
    }

    /**
     * Returns an instance of the query builder for this entity.
     *
     * @see OpportunityCategoryQueryBuilder The query builder class.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function query(): OpportunityCategoryQueryBuilder
    {
        return new OpportunityCategoryQueryBuilder($this->client, $this->usePostForQuery);
    }

    /**
     * Updates the opportunitycategory.
     *
     * @param  OpportunityCategoryEntity  $resource  The opportunitycategory entity to be updated.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function update(OpportunityCategoryEntity $resource): Response
    {
        return $this->client->put("OpportunityCategories", $resource->toArray());
    }
}