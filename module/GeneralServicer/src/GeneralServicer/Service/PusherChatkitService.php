<?php
namespace GeneralServicer\Service;

class PusherChatkitService
{

    private $generalService;

    private $entityManager;

    private $pusherClient;

    private $pusherService;

    private $chatkitSession;

    private $chatKit;

    private $centralBrokerUid;

    private $userEntity;

    /**
     * This initiate the chat room
     * @return \GeneralServicer\Service\PusherChatkitService|string
     */
    public function initiate()
    {
        $pusherUser = NULL;
        $userEntity = $this->userEntity;

        try {
            $pusherUser = $this->chatKit->getUser([
                "id" => strval($userEntity->getUsername())
            ]);

            $pusherAuth = $this->chatKit->authenticate([
                "user_id" => strval($userEntity->getUsername())
            ]);

            $this->chatkitSession->token = $pusherAuth["body"];

            return $this;
        } catch (\Exception $e) {
            return "User does not exist";
        }
    }

    /**
     * This creates the chat room name
     * 
     * @param string $roomName
     * @param string $centralbokerUser
     * @param array $members
     * @return \GeneralServicer\Service\PusherChatkitService|string
     */
    public function createChatRoom($roomName, $centralbokerUser, $members = array())
    {
        try {
            $this->chatKit->createRoom([
                "id" => strval($roomName),
                'creator_id' => strval($centralbokerUser),
                'name' => strval($roomName),
                'user_ids' => $members,
                'private' => true
            ]);
            return $this;
        } catch (\Exception $e) {
            return "Room could not be created";
        }
    }
    
    /**
     * This gets the chat room 
     * @param string $roomId
     * @return \GeneralServicer\Service\PusherChatkitService|string
     */
    public function getChatRoom($roomId){
        try{
            $this->chatKit->getRoom( ["id"=>strval($roomId)]);
            return $this;
        }catch (\Exception $e){
            return "Chat room do not exist";
        }
        
    }
    
    
    /**
     * A simple message is sent with this
     * @param string $senderId
     * @param string $roomId
     * @param string $text
     * @return \GeneralServicer\Service\PusherChatkitService
     */
    public function sendSimpleMessage($senderId, $roomId, $text){
        try{
            $this->chatKit->sendSimpleMessage(array(
                'sender_id' => strval($senderId),
                'room_id' => strval($roomId),
                'text' => $text
            ));
            return $this;
        }catch (\Exception $e){
            
        }
    }

    public function setChatKit($chatkit)
    {
        $this->chatKit = $chatkit;
        return $this;
    }

    public function setUserEntity($user)
    {
        $this->userEntity = $user;
        return $this;
    }

    public function setChatkitSession($session)
    {
        $this->chatkitSession = $session;
        return $this;
    }
}

