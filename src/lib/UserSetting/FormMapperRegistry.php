<?php

/**
 * @copyright Copyright (C) eZ Systems AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace EzSystems\EzPlatformUser\UserSetting;

use eZ\Publish\Core\Base\Exceptions\InvalidArgumentException;
use EzSystems\EzPlatformAdminUi\UserSetting as AdminUiUserSettings;

/**
 * @internal
 */
class FormMapperRegistry
{
    /** @var \EzSystems\EzPlatformAdminUi\UserSetting\FormMapperInterface[] */
    protected $formMappers;

    /**
     * @param \EzSystems\EzPlatformAdminUi\UserSetting\FormMapperInterface[] $formMappers
     */
    public function __construct(array $formMappers = [])
    {
        $this->formMappers = $formMappers;
    }

    /**
     * @param string $identifier
     * @param \EzSystems\EzPlatformUser\UserSetting\FormMapperInterface $formMapper
     */
    public function addFormMapper(
        string $identifier,
        AdminUiUserSettings\FormMapperInterface $formMapper
    ): void {
        $this->formMappers[$identifier] = $formMapper;
    }

    /**
     * @param string $identifier
     *
     * @return \EzSystems\EzPlatformUser\UserSetting\FormMapperInterface
     *
     * @throws \eZ\Publish\Core\Base\Exceptions\InvalidArgumentException
     */
    public function getFormMapper(string $identifier): AdminUiUserSettings\FormMapperInterface
    {
        if (!isset($this->formMappers[$identifier])) {
            throw new InvalidArgumentException(
                '$identifier',
                sprintf('There is no Form Mapper registered for \'%s\' identifier', $identifier)
            );
        }

        return $this->formMappers[$identifier];
    }

    /**
     * @return \EzSystems\EzPlatformAdminUi\UserSetting\FormMapperInterface[]
     */
    public function getFormMappers(): array
    {
        return $this->formMappers;
    }
}
