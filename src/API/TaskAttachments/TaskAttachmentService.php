<?php

namespace Anteris\Autotask\API\TaskAttachments;

use Anteris\Autotask\HttpClient;

/**
 * Handles all interaction with Autotask TaskAttachments.
 * @see https://ww14.autotask.net/help/DeveloperHelp/Content/AdminSetup/2ExtensionsIntegrations/APIs/REST/Entities/TaskAttachmentsEntity.htm Autotask documentation.
 */
class TaskAttachmentService
{
    /** @var Client An HTTP client for making requests to the Autotask API. */
    protected HttpClient $client;

    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Creates a new taskattachment.
     *
     * @param  TaskAttachmentEntity  $resource  The taskattachment entity to be written.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function create(TaskAttachmentEntity $resource)
    {
        $this->client->post("TaskAttachments", $resource->toArray());
    }

    /**
     * Deletes an entity by its ID.
     *
     * @param  int  $id  ID of the TaskAttachment to be deleted.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function deleteById(int $id): void
    {
        $this->client->delete("TaskAttachments/$id");
    }

    /**
     * Finds the TaskAttachment based on its ID.
     *
     * @param  string $id  ID of the entity to be retrieved.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function findById(int $id): TaskAttachmentEntity
    {
        return TaskAttachmentEntity::fromResponse(
            $this->client->get("TaskAttachments/$id")
        );
    }

    /**
     * Returns an instance of the query builder for this entity.
     *
     * @see TaskAttachmentQueryBuilder The query builder class.
     *
     * @author Aidan Casey <aidan.casey@anteris.com>
     */
    public function query(): TaskAttachmentQueryBuilder
    {
        return new TaskAttachmentQueryBuilder($this->client);
    }

}