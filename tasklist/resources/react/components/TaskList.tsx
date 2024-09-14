import React from 'react';

import { DragDropContext, Draggable, DraggingStyle, Droppable } from 'react-beautiful-dnd';

import { reorderTasks, TDraggingStyle, TTask } from '../utils';
import Task from './Task';

const getItemStyle = (isDragging: boolean, draggableStyle?: TDraggingStyle) => ({
  background: isDragging ? 'lightgreen' : '#FFF',
  ...draggableStyle,
});

function TaskList({
  tasks,
  setIsModalEditOpen,
  setModalEditTask,
  setIsModalDeleteOpen,
  setModalDeleteTaskId,
  projectId,
  setTasks,
}) {
  const handleDragEnd = (result) => {
    if (!result.destination || result.destination.index === result.source.index) {
      return;
    }

    const items = Array.from(tasks);
    const [reorderedItem] = items.splice(result.source.index, 1);

    items.splice(result.destination.index, 0, reorderedItem);
    reorderTasks(projectId, result.source.index + 1, result.destination.index + 1);

    setTasks(items);
  };

  return (
    <DragDropContext onDragEnd={handleDragEnd}>
      <Droppable droppableId="droppable">
        {(provided) => (
          <ul {...provided.droppableProps} ref={provided.innerRef}>
            {tasks.map((task: TTask, index: number) => (
              <Draggable key={task.id.toString()} draggableId={task.id.toString()} index={index}>
                {(provided, snapshot) => (
                  <li
                    ref={provided.innerRef}
                    {...provided.draggableProps}
                    {...provided.dragHandleProps}
                    className="task-item"
                    style={getItemStyle(snapshot.isDragging, provided.draggableProps.style)}
                  >
                    <Task
                      task={task}
                      setIsModalEditOpen={setIsModalEditOpen}
                      setModalEditTask={setModalEditTask}
                      setIsModalDeleteOpen={setIsModalDeleteOpen}
                      setModalDeleteTaskId={setModalDeleteTaskId}
                    />
                  </li>
                )}
              </Draggable>
            ))}
            {provided.placeholder}
          </ul>
        )}
      </Droppable>
    </DragDropContext>
  );
}

export default TaskList;
