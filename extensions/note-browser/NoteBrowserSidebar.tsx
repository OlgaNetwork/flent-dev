import React from 'react';

import { Sidebar } from '@bangle.io/ui-components';

import { NotesTree } from './NotesTree';

export function NoteBrowserSidebar() {
  return (
    <Sidebar.Container className="note-browser flex flex-col h-full">
      <div className="my-1 ml-4 mt-3 mr-3"> 
      <NotesTree /></div>
    </Sidebar.Container>
  );
}
