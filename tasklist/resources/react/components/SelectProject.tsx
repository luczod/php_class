import React, { ChangeEvent } from 'react';
import { getTasks } from '../utils';

function SelectProject({ projectId, projects, setProjectId, setTasks }) {
  const selectProject = (e: ChangeEvent<HTMLSelectElement>) => {
    const value = e.target.value;
    setProjectId(value);

    if (value === '') {
      setTasks([]);
    } else {
      getTasks(value).then((tasksData) => setTasks(tasksData));
    }
  };

  return (
    <div className="projects">
      <select className="projects-select" value={projectId} onChange={selectProject}>
        <option value="" defaultValue="true">
          Choose a project
        </option>
        {projects.map((project) => (
          <option key={project.id} value={project.id}>
            {project.name}
          </option>
        ))}
      </select>
    </div>
  );
}

export default SelectProject;
