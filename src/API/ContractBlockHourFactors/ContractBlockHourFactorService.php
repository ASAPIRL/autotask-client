<?php

namespace Anteris\Autotask\API\ContractBlockHourFactors;

use Anteris\Autotask\HttpClient;
use Anteris\Autotask\Support\EntityFields\EntityFieldCollection;
use Anteris\Autotask\Support\EntityInformation\EntityInformationEntity;
use GuzzleHttp\Psr7\Response;

/**
 * Handles all interaction with Autotask ContractBlockHourFactors.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/ContractBlockHourFactorsEntity.htm Autotask documentation.
 */
class ContractBlockHourFactorService
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
     * Creates a new contractblockhourfactor.
     *
     * @param  ContractBlockHourFactorEntity  $resource  The contractblockhourfactor entity to be written.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function create(ContractBlockHourFactorEntity $resource): Response
    {
        $contractID = $resource->contractID;
        return $this->client->post("Contracts/$contractID/BlockHourFactors", $resource->toArray());
    }

    /**
     * Finds the ContractBlockHourFactor based on its ID.
     *
     * @param  string $id  ID of the entity to be retrieved.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function findById(int $id): ContractBlockHourFactorEntity
    {
        return ContractBlockHourFactorEntity::fromResponse(
            $this->client->get("ContractBlockHourFactors/$id")
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
            $this->client->get("ContractBlockHourFactors/entityInformation/fields")
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
            $this->client->get("ContractBlockHourFactors/entityInformation")
        );
    }

    /**
     * Returns an instance of the query builder for this entity.
     *
     * @see ContractBlockHourFactorQueryBuilder The query builder class.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function query(): ContractBlockHourFactorQueryBuilder
    {
        return new ContractBlockHourFactorQueryBuilder($this->client, $this->usePostForQuery);
    }

    /**
     * Updates the contractblockhourfactor.
     *
     * @param  ContractBlockHourFactorEntity  $resource  The contractblockhourfactor entity to be updated.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function update(ContractBlockHourFactorEntity $resource): Response
    {
        $contractID = $resource->contractID;
        return $this->client->put("Contracts/$contractID/BlockHourFactors", $resource->toArray());
    }
}
