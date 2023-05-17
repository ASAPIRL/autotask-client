<?php

namespace Anteris\Autotask\API\ContractServiceAdjustments;

use Anteris\Autotask\HttpClient;
use Anteris\Autotask\Support\EntityFields\EntityFieldCollection;
use Anteris\Autotask\Support\EntityInformation\EntityInformationEntity;
use GuzzleHttp\Psr7\Response;

/**
 * Handles all interaction with Autotask ContractServiceAdjustments.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/ContractServiceAdjustmentsEntity.htm Autotask documentation.
 */
class ContractServiceAdjustmentService
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
     * Creates a new contractserviceadjustment.
     *
     * @param  ContractServiceAdjustmentEntity  $resource  The contractserviceadjustment entity to be written.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function create(ContractServiceAdjustmentEntity $resource): Response
    {
        $contractID = $resource->contractID;
        return $this->client->post("Contracts/$contractID/ServiceAdjustments", $resource->toArray());
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
            $this->client->get("ContractServiceAdjustments/entityInformation/fields")
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
            $this->client->get("ContractServiceAdjustments/entityInformation")
        );
    }
}
