<?php

namespace Anteris\Autotask\API\ResourceDailyAvailabilities;

use Anteris\Autotask\HttpClient;
use Anteris\Autotask\Support\EntityFields\EntityFieldCollection;
use Anteris\Autotask\Support\EntityInformation\EntityInformationEntity;
use GuzzleHttp\Psr7\Response;

/**
 * Handles all interaction with Autotask ResourceDailyAvailabilities.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/ResourceDailyAvailabilitiesEntity.htm Autotask documentation.
 */
class ResourceDailyAvailabilityService
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
     * Finds the ResourceDailyAvailability based on its ID.
     *
     * @param  string $id  ID of the entity to be retrieved.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function findById(int $id): ResourceDailyAvailabilityEntity
    {
        return ResourceDailyAvailabilityEntity::fromResponse(
            $this->client->get("ResourceDailyAvailabilities/$id")
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
            $this->client->get("ResourceDailyAvailabilities/entityInformation/fields")
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
            $this->client->get("ResourceDailyAvailabilities/entityInformation")
        );
    }

    /**
     * Returns an instance of the query builder for this entity.
     *
     * @see ResourceDailyAvailabilityQueryBuilder The query builder class.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function query(): ResourceDailyAvailabilityQueryBuilder
    {
        return new ResourceDailyAvailabilityQueryBuilder($this->client, $this->usePostForQuery);
    }

    /**
     * Updates the resourcedailyavailability.
     *
     * @param  ResourceDailyAvailabilityEntity  $resource  The resourcedailyavailability entity to be updated.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function update(ResourceDailyAvailabilityEntity $resource): Response
    {
        return $this->client->put("ResourceDailyAvailabilities", $resource->toArray());
    }
}
