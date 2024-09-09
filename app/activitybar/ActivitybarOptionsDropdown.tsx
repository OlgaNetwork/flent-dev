import React, { useCallback } from 'react';

import { useSerialOperationContext } from '@bangle.io/api';
import { useNsmSlice } from '@bangle.io/bangle-store-context';
import {
  CHANGELOG_MODAL_NAME,
  CORE_OPERATIONS_NEW_NOTE,
  CORE_OPERATIONS_NEW_WORKSPACE,
  CORE_PALETTES_TOGGLE_NOTES_PALETTE,
  CORE_PALETTES_TOGGLE_OPERATION_PALETTE,
  CORE_PALETTES_TOGGLE_WORKSPACE_PALETTE,
  CorePalette,
} from '@bangle.io/constants';
import type { SidebarType } from '@bangle.io/extension-registry';
import type { SerialOperationKeybindingMapping } from '@bangle.io/shared-types';
import { nsmUI, nsmUISlice } from '@bangle.io/slice-ui';
import {
  BangleIcon,
  DiscordIcon,
  DotsVerticalIcon,
  DropdownMenu,
  GiftIcon,
  MenuItem,
  MenuSection,
  PrettyKeybinding,
  SettingsIcon,
  TwitterIcon,
} from '@bangle.io/ui-components';

import { ButtonStyleOBj } from './common';

export const ActionPaletteKey = 'ActionPalette';
export const DiscordKey = 'Discord';
export const NewNoteKey = 'NewNote';
export const NewWorkspaceKey = 'NewWorkspace';
export const NotesPaletteKey = 'NotesPalette';
export const ReportIssueKey = 'ReportIssue';
export const SwitchWorkspaceKey = 'SwitchWorkspace';
export const ToggleThemeKey = 'ToggleTheme';
export const TwitterKey = 'Twitter';
export const NotionKey = 'Notion';
export const WhatsNewKey = 'WhatsNewKey';
export const ExitKey = 'Exit';

type AllKeysType =
  | typeof ActionPaletteKey
  | typeof DiscordKey
  | typeof NewNoteKey
  | typeof NewWorkspaceKey
  | typeof NotesPaletteKey
  | typeof ReportIssueKey
  | typeof SwitchWorkspaceKey
  | typeof ToggleThemeKey
  | typeof ExitKey  
  | typeof TwitterKey
  | typeof NotionKey
  | typeof WhatsNewKey;

  

export function ActivitybarOptionsDropdown({
  widescreen,
  operationKeybindings,
  sidebarItems,
  activeSidebar,
}: {
  widescreen: boolean;
  operationKeybindings: SerialOperationKeybindingMapping;
  sidebarItems?: SidebarType[];
  activeSidebar?: string;
}) {
  const [, uiDispatch] = useNsmSlice(nsmUISlice);

  const { dispatchSerialOperation } = useSerialOperationContext();

  const handleDropdown = useCallback(
    (k: any) => {
      let key: AllKeysType = k;
      switch (key) {
        case ActionPaletteKey: {
          uiDispatch(nsmUI.togglePalette(CorePalette.Operation));
          break;
        }
        case NewNoteKey: {
          dispatchSerialOperation({
            name: CORE_OPERATIONS_NEW_NOTE,
          });
          break;
        }
        case NewWorkspaceKey: {
          dispatchSerialOperation({
            name: CORE_OPERATIONS_NEW_WORKSPACE,
          });
          break;
        }
        case NotesPaletteKey: {
          uiDispatch(nsmUI.togglePalette(CorePalette.Notes));
          break;
        }
        case ReportIssueKey: {
          window.open(
            'https://flent.ru/help',
            '_blank',
          );
          break;
        }
        case SwitchWorkspaceKey: {
          uiDispatch(nsmUI.togglePalette(CorePalette.Workspace));
          break;
        }

        case ToggleThemeKey: {
          uiDispatch(nsmUI.toggleColorSchema());
          break;
        }

        case DiscordKey: {
          window.open('https://flent.ru', '_blank');
          break;
        }

        case TwitterKey: {
          window.open('https://t.me/flent_notes', '_blank');
          break;
        }

        case NotionKey: {
          window.open('https://flent.ru/import/notion/', '_blank');
          break;
        }
        
        case ExitKey: {
          window.open('https://flent.ru', '');
          break;
        }

        case WhatsNewKey: {
          uiDispatch(
            nsmUI.showDialog({
              dialogName: CHANGELOG_MODAL_NAME,
            }),
          );

          break;
        }
        default: {
          const match = sidebarItems?.find((i) => i.name === k);

          if (match) {
            if (match.name !== activeSidebar) {
              uiDispatch(nsmUI.changeSidebar(match.name));
            }
          }
        }
      }
    },
    [activeSidebar, dispatchSerialOperation, uiDispatch, sidebarItems],
  );

  const sidebarChildren: any =
    sidebarItems?.map((item) => {
      return (
        <MenuItem
          key={item.name}
          textValue={item.title}
          aria-label={item.title}
        >
          {item.title}
          {React.cloneElement(item.activitybarIcon, {
            className:
              (item.activitybarIcon.props.className || '') + ' w-5 h-5',
          })}
        </MenuItem>
      );
    }) || null;

  return (
    <DropdownMenu
      buttonProps={{
        variant: 'transparent',
        ariaLabel: 'options menu',
        size: widescreen ? 'lg' : 'sm',
        tone: 'secondary',
        //  we need this to use the activitybar color of the icon
        style: widescreen ? ButtonStyleOBj.normal : undefined,

        leftIcon: widescreen ? <SettingsIcon /> : <DotsVerticalIcon />,
        onHoverStyle: ButtonStyleOBj.hover,
        onPressStyle: ButtonStyleOBj.press,
      }}
      menuProps={{
        ariaLabel: 'options dropdown',
        placement: widescreen ? 'right-start' : 'bottom-start',
      }}
      onAction={handleDropdown}
    >
      <MenuSection aria-label="misc section">


        <MenuItem aria-label="new note" key={NewNoteKey}>
          Новая заметка
          {widescreen && (
            <PrettyKeybinding
              rawKey='Cmd-y'
            />
          )}
        </MenuItem>
      {widescreen && 
        <MenuItem aria-label="new workspace" key={NewWorkspaceKey}>
          Новый проект
        </MenuItem>
      }
        
      </MenuSection>
      {sidebarChildren && (
        <MenuSection aria-label="activitybar section">
          {sidebarChildren}
        </MenuSection>
      )}
      <MenuSection aria-label="ui section">

      {widescreen && 
        <MenuItem
          key={NotesPaletteKey}
          textValue="notes palette"
          aria-label="notes palette"
        >
          <span>Заметки</span>
          {widescreen && (
            <PrettyKeybinding
              rawKey={
                operationKeybindings[CORE_PALETTES_TOGGLE_NOTES_PALETTE] ||
                ''
              }
            />
          )}
        </MenuItem>
        }
      {widescreen &&         
       <MenuItem
          aria-label="switch workspace"
          key={SwitchWorkspaceKey}
          textValue="switch workspace"
        >
          <span>Проекты</span>
          {widescreen && (
            <PrettyKeybinding
              rawKey={
                operationKeybindings[CORE_PALETTES_TOGGLE_WORKSPACE_PALETTE] ||
                ''
              }
            />
          )}
        </MenuItem>
      }
      {widescreen && 
          <MenuItem
            key={ActionPaletteKey}
            textValue="operation palette"
            aria-label="operation palette"
          >
            <span>Быстрая панель</span>
            {widescreen && (
              <PrettyKeybinding
                rawKey={
                  operationKeybindings[CORE_PALETTES_TOGGLE_OPERATION_PALETTE] ||
                  ''
                }
              />
            )}
          </MenuItem>
        }

        <MenuItem aria-label="Switch Dark/Light theme" key={ToggleThemeKey}>
          Светлая/темная тема
        </MenuItem>

      <MenuItem
          key={NotionKey}
          textValue=""
          aria-label=""
        >
          <span>Перенести из Notion</span>
        </MenuItem>
      </MenuSection>

      <MenuSection aria-label="links section">
        <MenuItem
          key={WhatsNewKey}
          textValue="whats new"
          aria-label="whats new"
        >
          <span>Что нового?</span>
          <GiftIcon className="w-5 h-5" />
        </MenuItem>
        <MenuItem
          key={ReportIssueKey}
          textValue=""
          aria-label=""
        >
          <span>Помощь</span>
          <BangleIcon className="w-5 h-5" />
        </MenuItem>
        <MenuItem
          key={TwitterKey}
          textValue="follow"
          aria-label="follow"
        >
          <span>Flent в Телеграм</span>
          <TwitterIcon className="w-5 h-5" />
        </MenuItem>
        <MenuItem
          key={DiscordKey}
          textValue=""
          aria-label=""
        >
          <span>Flent (официальный сайт)</span>
          <DiscordIcon className="w-5 h-5" />
        </MenuItem>
      </MenuSection>

      <MenuSection aria-label="links section">
        <MenuItem
          key={ExitKey}
          textValue=""
          aria-label=""
        >
          <span>Выход</span>
        </MenuItem>
      </MenuSection>
      
    </DropdownMenu>
  );
}
