import { useMemo } from 'react';

import {
  bulletList,
  listItem,
  orderedList,
  paragraph,
} from '@bangle.dev/base-components';
import type { EditorState, EditorView } from '@bangle.dev/pm';
import { setBlockType } from '@bangle.dev/pm';
import { rafCommandExec } from '@bangle.dev/utils';

import { replaceSuggestionMarkWith } from '@bangle.io/inline-palette';
import { assertNotUndefined } from '@bangle.io/utils';

import {
  chainedInsertParagraphAbove,
  chainedInsertParagraphBelow,
  isList,
} from './commands';
import { palettePluginKey } from './config';
import { PaletteItem } from './palette-item';

const { convertToParagraph } = paragraph;
const {
  toggleBulletList,
  toggleTodoList,
  queryIsBulletListActive,
  queryIsTodoListActive,
} = bulletList;
const { insertEmptySiblingListAbove, insertEmptySiblingListBelow } = listItem;
const { toggleOrderedList, queryIsOrderedListActive } = orderedList;

const setHeadingBlockType =
  (level: number) =>
  (state: EditorState, dispatch: EditorView['dispatch'] | undefined) => {
    const type = state.schema.nodes.heading;

    assertNotUndefined(type, 'заголовок должен быть определен');

    return setBlockType(type, { level })(state, dispatch);
  };

export function useEditorItems() {
  const baseItem = useMemo(
    () => [
      PaletteItem.create({
        uid: 'paraBelow',
        title: 'Вставите абзац ниже ↓',
        group: 'editor',
        description: 'Вставляет новый абзац под этим блоком',
        // TODO current just disabling it, but we need to implement this method for lists
        disabled: (state: any) => {
          return isList()(state);
        },
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, chainedInsertParagraphBelow());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'paraAbove',
        title: 'Вставить абзац выше ↑',
        group: 'editor',
        description: 'Вставляет новый абзац над этим блоком',
        disabled: (state: any) => {
          return isList()(state);
        },
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, chainedInsertParagraphAbove());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'paraConvert',
        title: 'Абзац',
        group: 'editor',
        description: 'Преобразовать текущий блок в абзац',
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(
                view,
                (
                  state: EditorState,
                  dispatch: EditorView['dispatch'] | undefined,
                  view: EditorView | undefined,
                ) => {
                  if (queryIsTodoListActive()(state)) {
                    return toggleTodoList()(state, dispatch, view);
                  }
                  if (queryIsBulletListActive()(state)) {
                    return toggleBulletList()(state, dispatch, view);
                  }
                  if (queryIsOrderedListActive()(state)) {
                    return toggleOrderedList()(state, dispatch, view);
                  }

                  return convertToParagraph()(state, dispatch, view);
                },
              );
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'bulletListConvert',
        title: 'Список маркеров',
        group: 'editor',
        keywords: ['unordered', 'lists'],
        description: 'Преобразовать текущий блок в маркированный список',
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, toggleBulletList());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'todoListConvert',
        title: 'Todo',
        group: 'editor',
        keywords: ['todo', 'lists', 'checkbox', 'checked'],
        description: 'Преобразовать текущий блок в список дел',
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, toggleTodoList());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'orderedListConvert',
        group: 'editor',
        title: 'Список по номерам',
        keywords: ['numbered', 'lists'],
        description: 'Преобразовать текущий блок в упорядоченный список',
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, toggleOrderedList());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'insertSiblingListAbove',
        group: 'editor',
        title: 'Вставить список выше ↑',
        keywords: ['insert', 'above', 'lists'],
        description: 'Вставить элемент списка над текущим элементом списка',
        disabled: (state: any) => {
          return !isList()(state);
        },
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              rafCommandExec(view, insertEmptySiblingListAbove());
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      PaletteItem.create({
        uid: 'insertSiblingListBelow',
        group: 'editor',
        title: 'Вставить список ниже ↓',
        keywords: ['insert', 'below', 'lists'],
        description: 'Вставить элемент списка под текущим элементом списка',
        disabled: (state: any) => {
          return !isList()(state);
        },
        editorExecuteCommand: () => {
          return (
            state: EditorState,
            dispatch: EditorView['dispatch'] | undefined,
            view: EditorView | undefined,
          ) => {
            if (view) {
              if (view) {
                rafCommandExec(view, insertEmptySiblingListBelow());
              }
            }

            return replaceSuggestionMarkWith(palettePluginKey, '')(
              state,
              dispatch,
              view,
            );
          };
        },
      }),

      ...Array.from({ length: 3 }, (_, i) => {
        const level = i + 1;

        return PaletteItem.create({
          uid: 'headingConvert' + level,
          title: 'H' + level,
          group: 'editor',
          description: 'Преобразовать текущий блок в уровень заголовка ' + level,
          disabled: (state: any) => {
            const result = isList()(state);

            return result;
          },
          editorExecuteCommand: () => {
            return (
              state: EditorState,
              dispatch: EditorView['dispatch'] | undefined,
              view: EditorView | undefined,
            ) => {
              if (view) {
                rafCommandExec(view, setHeadingBlockType(level));
              }

              return replaceSuggestionMarkWith(palettePluginKey, '')(
                state,
                dispatch,
                view,
              );
            };
          },
        });
      }),
    ],
    [],
  );

  return baseItem;
}
