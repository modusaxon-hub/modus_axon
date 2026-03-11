# MODUS AXON: Work Master Flow

Este documento define la ley operativa para el desarrollo inteligente y concatenado de todos los proyectos bajo la firma MODUS AXON.

## 1. Gobernanza de Documentación (Constitución del Software)
- **Centralización**: MODUS AXON actúa como el core del software. Ningún proyecto individual debe contener documentación técnica definitiva fuera de sus archivos de operación.
- **Ubicación Maestra**: `d:/Documentos/Proyectos ADSO/modus_axon/technical/projects/[project_name]/`
- **Trazabilidad Independiente**: Cada proyecto mantiene su propia bitácora cronológica dentro de la matriz, asegurando que la historia de cada activo sea trazable de forma aislada pero centralizada.
- **Nomenclatura Cronológica**: Los archivos deben seguir el formato `YYYY-MM-DD_ID-XXXX_Asunto.md`.

## 2. Conector Inteligente del Proyecto (Satellite System)
Cada proyecto (ej. Origen, Jacquin, Despensa) tiene un archivo `modus-connector.md` en su raíz que...
- `projectId`: ID único del proyecto.
- `masterPath`: Enlace a su bitácora en MODUS AXON.
- `triggers`: Lista de comandos de agentes asociados.
- `notebookLmId`: Referencia al cuaderno de investigación de NotebookLM.

## 3. Flujo de Trabajo (Master Loop)
1. **Detección**: El agente lee el conector del proyecto.
2. **Sincronización**: Se verifica si hay cambios en la Bitácora de MODUS AXON.
3. **Ejecución**: El agente actúa localmente basándose en las instrucciones maestras.
4. **Registro**: Cada cambio genera una entrada cronológica en la Bitácora Maestra con un ID único.

## 4. Equipo de Trabajo (Agent Orchestration)
- **Integrantes**: El directorio `agent/` dentro de MODUS AXON representa al equipo de trabajo y sus habilidades especializadas.
- **Skills**: Los agentes invocan habilidades desde `modus_axon/agent/skills/` para ejecutar tareas complejas con trazabilidad centralizada.

## 5. Base de Conocimiento (NotebookLM)
- **Documentación de Consulta**: El directorio `notebook_lm/` centraliza la investigación financiera, jurídica, de diseño y análisis.
- **Sincronización**: NotebookLM actúa como el cerebro de consulta para la toma de decisiones estratégicas del software matriz.

---
*Firma: MODUS AXON - Desarrollo Inteligente Concatenado*
