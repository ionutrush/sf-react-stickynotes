<?php

namespace App\Controller\v1;

use App\DTO\CreateStickyNoteRequest;
use App\DTO\StickyNoteDTO;
use App\DTO\UpdateStickyNoteRequest;
use App\Entity\StickyNote;
use App\Security\Voter\StickyNoteVoter;
use App\Service\StickyNoteService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/v1/notes')]
final class StickyNoteController extends AbstractController {

    public function __construct(private readonly StickyNoteService $service) {}

    #[Route('', name: 'app_v1_get_sticky_notes', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json(
            array_map(
                fn($note) => new StickyNoteDTO($note),
                $this->service->getAllNotes()
            )
        );
    }

    #[Route('', name: 'app_v1_create_sticky_note', methods: ['POST'])]
    public function create(#[MapRequestPayload] CreateStickyNoteRequest $request): JsonResponse
    {
        try {
            $note = $this->service->create($request->color, $request->position, $request->body);

            return $this->json(
                new StickyNoteDTO($note),
                Response::HTTP_CREATED
            );
        } catch (\Exception $e) {
            return $this->json(
                [
                    'message' => 'Creating a sticky note failed.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/{note}', name: 'app_v1_update_sticky_note', methods: ['PUT'])]
    public function update(
        StickyNote $note,
        #[MapRequestPayload]
        UpdateStickyNoteRequest $request
    ): JsonResponse
    {
        $this->denyAccessUnlessGranted(StickyNoteVoter::EDIT, $note);

        try {
            $note = $this->service->update($note, $request->color, $request->position, $request->body);
            return $this->json(
                new StickyNoteDTO($note),
                Response::HTTP_OK
            );
        } catch (\Exception $e) {
            return $this->json(
                [
                    'message' => 'Updating a sticky note failed.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    #[Route('/{note}', name: 'app_v1_delete_sticky_note', methods: ['DELETE'])]
    public function delete(StickyNote $note): JsonResponse
    {
        $this->denyAccessUnlessGranted(StickyNoteVoter::DELETE, $note);

        try {
            $this->service->delete($note);
            return $this->json(null, Response::HTTP_NO_CONTENT);
        } catch (\Exception $e) {
            return $this->json(
                [
                    'message' => 'Deleting a sticky note failed.',
                    'error' => $e->getMessage(),
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
