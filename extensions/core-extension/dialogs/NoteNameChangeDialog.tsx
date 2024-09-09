import React, { useCallback, useState } from 'react';

import { nsmApi2 } from '@bangle.io/api';
import {
  NEW_NOTE_DIALOG_NAME,
  RENAME_NOTE_DIALOG_NAME,
  SEVERITY,
} from '@bangle.io/constants';
import { InputPalette, UniversalPalette } from '@bangle.io/ui-components';
import { BaseError, randomName, useDestroyRef } from '@bangle.io/utils';
import {
  createWsPath,
  filePathToWsPath,
  isValidNoteWsPath,
  PathValidationError,
  resolvePath,
} from '@bangle.io/ws-path';

export function NewNoteInputModal() {
  const { dialogName, dialogMetadata } = nsmApi2.ui.uiState();

  const onDismiss = useCallback((focusEditor = true) => {
    nsmApi2.ui.dismissDialog(NEW_NOTE_DIALOG_NAME);

    if (focusEditor) {
      nsmApi2.editor.getPrimaryEditor()?.focusView();
    }
  }, []);

  const destroyedRef = useDestroyRef();
  const { wsName } = nsmApi2.workspace.useWorkspace();
  const [error, updateError] = useState<Error | undefined>();
  const { widescreen } = nsmApi2.ui.useUi();

  const onExecute = useCallback(
    async (inputValue) => {
      if (
        !inputValue ||
        inputValue.endsWith('/') ||
        inputValue.endsWith('/.md')
      ) {
        updateError(new Error('Необходимо указать название записи'));

        return;
      }
      if (!wsName) {
        updateError(new Error('Нет открытого проекта'));

        return;
      }
      let newWsPath = filePathToWsPath(wsName, inputValue);

      if (!isValidNoteWsPath(newWsPath)) {
        newWsPath += '.md';
      }
      try {
        await nsmApi2.workspace.createNote(createWsPath(newWsPath), {
          open: true,
        });

        onDismiss();
      } catch (error) {
        if (!(error instanceof Error)) {
          throw error;
        }
        if (destroyedRef.current) {
          return;
        }
        updateError(error);

        if (!(error instanceof PathValidationError)) {
          throw error;
        }
      }
    },
    [onDismiss, destroyedRef, wsName],
  );


const emodjiList = [
  "🍎", "🍊", "🍌", "🍉", "🍇", "🍓", "🍒", "🍍", "🥥", "🥝",
  "🍅", "🥑", "🍆", "🥒", "🌶️", "🥕", "🌽", "🥔", "🍠", "🥦",
  "🥬", "🥗", "🥕", "🌰", "🍄", "🥜", "🌯", "🌮", "🍣", "🍱",
  "🍤", "🍙", "🍚", "🍛", "🍜", "🍲", "🍝", "🍞", "🥐", "🥖",
  "🥨", "🥯", "🧀", "🥚", "🍳", "🥞", "🥓", "🥩", "🍗", "🍖",
  "🌭", "🍔", "🍟", "🍕", "🥪", "🥙", "🥫", "🍝", "🥧", "🍰",
  "🎂", "🍮", "🍭", "🍬", "🍫", "🍿", "🍩", "🍪", "🥠", "🥧",
  "🍼", "☕", "🍵", "🍶", "🍺", "🍻", "🍷", "🥂", "🥃", "🍸",
  "🍹", "🍾", "🥤", "🧃", "🧉", "🧊", "🍽️", "🍴", "🥄", "🔪",
  "🏺", "🌍", "🌎", "🌏", "🌐", "👽", "🌒", "🌓", "🌔", "🌕",
  "🌖", "🌗", "🌘", "🌙", "🌚", "🌛", "🌜", "🌡️", "☀️", "🌤️",
  "⛅", "🌥️", "🌦️", "🌧️", "🌨️", "🌩️", "🌪️", "🌬️", "🌀",
  "🌂", "☂️", "☔", "⛱️", "⚡", "❄️", "☃️", "☄️",
  "🔥", "💧", "🌊", "🎄", "✨", "🎇", "🎆", "🧨", "🎈", "🎉",
  "🎊", "🎎", "🎏", "🎐", "🎀", "🎁", "🎫", "🎟️", "🎗️", "🏆",
  "🥇", "🥈", "🥉", "⚽", "⚾", "🏀", "🏐", "🏈", "🏉", "🎾",
  "🎳", "🏏", "🏑", "🏒", "🥍", "🏓", "🏸", "🥊", "🥋", "🥅",
  "⛳", "⛸️", "🎣", "🤿", "🎽", "🎿", "🛷", "🥌", "🎯", "🪀",
  "🪁", "🎱", "🎲", "🧩", "♟️", "🎮", "🕹️", "🎰", "🎲", "🧸",
  "🪅", "🪆", "🪄", "🪢", "🪡", "🪚", "🪛", "🪜", "🪝", "🛠️",
  "🛢️", "🧲", "🪑", "🚪", "🛏️", "🛋️", "🚿", "🛁",
  "🪒", "🧴", "🧷", "🧹", "🧺", "🧻", "🧼", "🧯", "🛒",
  "🚬", "⚰️", "🪦", "⚱️", "🏺", "🧭", "🧱", "🔧", "🔨", "⚙️",
  "⛓️", "🔩", "🔗", "🗜️", "⚒️", "🛠️", "⛏️", "🪓", "🔫", "💣",
  "🧨", "🪃", "🪁", "🎣", "🪒", "🪚", "🔍", "🔬", "🔭", "📡",
  "💉", "💊", "🩹", "🩺", "🚪", "🛏️", "🛋️", "🚿", "🛁", "🧴",
  "🧷", "🧹", "🧺", "🧻", "🧼", "🧽", "🧯", "🚬", "⚰️", "🪦",
  "⚱️", "🏺", "🧭", "🧱", "🔧", "🔨", "⚙️", "⛓️", "🔩", "🔗",
  "🗜️", "⚒️", "🛠️", "⛏️", "🪓", "🔫", "💣", "🧨", "🪃", "🪁",
  "🎣", "🪒", "🪚", "🔍", "🔬", "🔭", "📡", "💉", "💊", "🩹",
  "🩺", "🚪", "🛏️", "🛋️", "🚿", "🛁", "🧴", "🧷", "🧹", "🧺",
  "🧻", "🧼", "🧽", "🧯", "⚱️", "🏺", "🧭",
  "🧱", "🔧", "🔨", "⚙️", "⛓️", "🔩", "🔗", "🗜️", "⚒️", "🛠️",
  "🛟", "⚓️", "🚘", "🧨", "💰", "🪆", "🎈", 
  "🍿", "🕺", "🏻", "🦊", "🧶", "🌞", "🤖", "🧵", "👗", "🐱", "🐶", "💥", "🔥", "☄️", "⚡️", "⭐️", "🎯", "⛱", 
  "⛏️", "🪓", "💣", "🧨", "🪃"]; // Массив с эмодзи


const randomEmodji = emodjiList[Math.floor(Math.random() * emodjiList.length)]; // Выбираем случайный эмодзи из списка


  if (dialogName !== NEW_NOTE_DIALOG_NAME) {
    return null;
  }

  return (
    <InputPalette
      placeholder="Введите название записи"
      onExecute={onExecute}
      onDismiss={onDismiss}
      updateError={updateError}
      error={error}
      widescreen={widescreen}
      initialValue={dialogMetadata?.initialValue || randomEmodji+" "}
      selectOnMount={true}
    >
      <UniversalPalette.PaletteInfo>
        <UniversalPalette.PaletteInfoItem>
          
        </UniversalPalette.PaletteInfoItem>
      </UniversalPalette.PaletteInfo>
    </InputPalette>
  );
}

export function RenameNoteInputModal() {
  const onDismiss = useCallback((focusEditor = true) => {
    nsmApi2.ui.dismissDialog(RENAME_NOTE_DIALOG_NAME);

    if (focusEditor) {
      nsmApi2.editor.focusEditorIfNotFocused();
    }
  }, []);

  const destroyedRef = useDestroyRef();
  const { widescreen } = nsmApi2.ui.useUi();
  const { wsName } = nsmApi2.workspace.useWorkspace();

  const targetWsPath = nsmApi2.editor.getFocusedWsPath();

  const [error, updateError] = useState<Error | undefined>();
  const onExecute = useCallback(
    async (inputValue) => {
      if (
        !inputValue ||
        inputValue.endsWith('/') ||
        inputValue.endsWith('/.md')
      ) {
        updateError(new Error('Must provide a note name'));

        return;
      }

      if (!wsName) {
        updateError(new Error('No workspace open'));

        return;
      }

      if (!targetWsPath) {
        updateError(new Error('No note active'));

        return;
      }

      let newWsPath = filePathToWsPath(wsName, inputValue);

      if (!isValidNoteWsPath(newWsPath)) {
        newWsPath += '.md';
      }
      try {
        const targetWsPathFixed = createWsPath(targetWsPath);
        const newWsPathFixed = createWsPath(newWsPath);
        await nsmApi2.workspace.renameNote(targetWsPathFixed, newWsPathFixed);
        onDismiss();
      } catch (error) {
        if (destroyedRef.current) {
          return;
        }
        onDismiss();

        if (!(error instanceof Error)) {
          throw error;
        }

        if (error instanceof BaseError) {
          nsmApi2.ui.showNotification({
            severity: SEVERITY.ERROR,
            uid: 'error-rename-note-' + targetWsPath,
            title: 'Unable to rename note',
            content: error.message,
          });

          return;
        }

        // TODO fix this
        // // pass it to the store to let the storage handler handle it
        // bangleStore.errorHandler(error);
      }
    },
    [targetWsPath, onDismiss, destroyedRef, wsName],
  );

  const initialValue = targetWsPath ? resolvePath(targetWsPath).filePath : '';

  return (
    <InputPalette
      placeholder="Enter the new name"
      onExecute={onExecute}
      onDismiss={onDismiss}
      updateError={updateError}
      error={error}
      initialValue={initialValue}
      selectOnMount={true}
      widescreen={widescreen}
    >
      <UniversalPalette.PaletteInfo>
        <UniversalPalette.PaletteInfoItem>
          You are currently renaming "{initialValue}"
        </UniversalPalette.PaletteInfoItem>
      </UniversalPalette.PaletteInfo>
    </InputPalette>
  );
}
